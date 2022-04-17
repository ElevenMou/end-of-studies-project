<?php

namespace App\Http\Livewire\Enseignants;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public $users, $usersPerPage = 20;
    public $userStatu = 1;          // 1=active 3=suspende 4=search
    public $usersCount, $suspendCount;
    public $newUser = false;

    protected $rules = [
        'search' => 'required|numeric|max:19999999|min:1999999|'
    ];

    protected $messages = [
        'search.max' => 'Matricule non valid.',
        'search.min' => 'Matricule non valid.',
        'search.numeric' => 'Matricule non valid.'
    ];

    protected $listeners = ['newProf'];

    public function newProf()
    {
        $this->usersCount++;
        $this->users = User::latest()->where('statu', 1)->where('type', 1)->take($this->usersPerPage)->get('*');
    }

    public function mount()
    {
        if (Auth::user()->type != 2) {
            return redirect('/');
        }
        $this->users = User::latest()->where('statu', 1)->where('type', 1)->take($this->usersPerPage)->get('*');
        $this->usersCount = User::where('statu', 1)->where('type', 1)->count();
        $this->suspendCount = User::where('statu', 3)->where('type', 1)->count();
    }

    /************** VOIR PLUS **************/
    public function newUser()
    {
        $this->newUser = !$this->newUser;
    }

    /************** VOIR PLUS **************/
    public function loadMore()
    {
        $this->usersPerPage = $this->usersPerPage + 20;

        if ($this->userStatu == 1) {
            $this->users = User::latest()->where('statu', 1)->where('type', 1)->take($this->usersPerPage)->get('*');
        } elseif ($this->userStatu == 3) {
            $this->users = User::latest()->where('statu', 3)->where('type', 1)->take($this->usersPerPage)->get('*');
        }
    }

    /************** ACTIVE UTILISATEURS **************/
    public function indexUsers()
    {
        $this->userStatu = 1;
        $this->usersPerPage = 20;
        $this->users = $this->users = User::latest()->where('statu', 1)->where('type', 1)->take($this->usersPerPage)->get('*');
    }

    /************** SUSPENDE UTILISATEURS **************/
    public function usersSuspend()
    {
        $this->userStatu = 3;
        $this->usersPerPage = 20;
        $this->users = User::latest()->where('statu', 3)->where('type', 1)->take($this->usersPerPage)->get('*');
    }

    /************** RECHERCHE UTILISATEURS **************/
    public function searchUser()
    {
        $this->validate();
        $this->userStatu = 4;
        $this->users = User::where('identifiant', $this->search)->where('type', 1)->get();
    }
    /************** ACTIONS **************/

    public function suspendre($user_id)
    {
        $user = User::find($user_id);
        $user->update([
            'statu' => 3
        ]);
        if ($this->userStatu == 1) {
            $this->users = User::latest()->where('statu', 1)->where('type', 1)->take($this->usersPerPage)->get('*');
        } elseif ($this->userStatu == 4) {
            $this->users = User::where('identifiant', $this->search)->where('statu', '<>', 0)->get('*');
        }

        $this->usersCount = User::where('statu', 1)->where('type', 1)->count();
        $this->suspendCount = User::where('statu', 3)->where('type', 1)->count();
    }

    public function continuer($user_id)
    {
        $user = User::find($user_id);
        $user->update([
            'statu' => 1
        ]);
        if ($this->userStatu == 3) {
            $this->users = User::latest()->where('statu', 3)->where('type', 1)->take($this->usersPerPage)->get('*');
        } elseif ($this->userStatu == 4) {
            $this->users = User::where('identifiant', $this->search)->where('statu', '<>', 0)->get('*');
        }

        $this->usersCount = User::where('statu', 1)->where('type', 1)->count();
        $this->suspendCount = User::where('statu', 3)->where('type', 1)->count();
    }

    public function render()
    {
        return view('livewire.enseignants.index');
    }
}
