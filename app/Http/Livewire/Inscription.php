<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Inscription extends Component
{
    public $search;
    public $users, $usersPerPage = 1;
    public $userStatu = 1;          // 0=demande 1=active 3=suspende
    public $demandeCount, $usersCount, $suspendCount;

    protected $rules = [
        'search' => 'required|numeric|max:19999999|min:1999999|'
    ];

    protected $messages = [
        'search.max' => 'Apogée non valid.',
        'search.min' => 'Apogée non valid.',
        'search.numeric' => 'Apogée non valid.'
    ];

    public function mount()
    {
        if (Auth::user()->type != 2) {
            return redirect('/');
        }
        $this->users = User::latest()->where('statu', 1)->where('type', 0)->take($this->usersPerPage)->get('*');
        $this->demandeCount = User::where('statu', 0)->where('type', 0)->count();
        $this->usersCount = User::where('statu', 1)->where('type', 0)->count();
        $this->suspendCount = User::where('statu', 3)->where('type', 0)->count();
    }

    /************** VOIR PLUS **************/
    public function loadMore()
    {
        $this->usersPerPage = $this->usersPerPage + 1;
        if ($this->userStatu == 0) {
            $this->users = User::latest()->where('statu', 0)->where('type', 0)->take($this->usersPerPage)->get('*');
        } elseif ($this->userStatu == 1) {
            $this->users = User::latest()->where('statu', 1)->where('type', 0)->take($this->usersPerPage)->get('*');
        } elseif ($this->userStatu == 3) {
            $this->users = User::latest()->where('statu', 3)->where('type', 0)->take($this->usersPerPage)->get('*');
        }
    }

    /************** DEMANDE D'INSCRIPTION **************/
    public function usersDemande()
    {
        $this->userStatu = 0;
        $this->usersPerPage = 1;
        $this->users = User::latest()->where('statu', 0)->where('type', 0)->take($this->usersPerPage)->get('*');
    }

    /************** ACTIVE UTILISATEURS **************/
    public function indexUsers()
    {
        $this->userStatu = 1;
        $this->usersPerPage = 1;
        $this->users = $this->users = User::latest()->where('statu', 1)->where('type', 0)->take($this->usersPerPage)->get('*');
    }

    /************** SUSPENDE UTILISATEURS **************/
    public function usersSuspend()
    {
        $this->userStatu = 3;
        $this->usersPerPage = 1;
        $this->users = User::latest()->where('statu', 3)->where('type', 0)->take($this->usersPerPage)->get('*');
    }

    /************** RECHERCHE UTILISATEURS **************/
    public function searchUser()
    {
        $this->validate();

        $this->userStatu = 4;
        $this->users = User::where('identifiant', $this->search)->where('statu', '<>', 0)->get('*');
    }
    /************** ACTIONS **************/
    public function accepter($user_id)
    {
        $user = User::find($user_id);
        $user->update([
            'statu' => 1
        ]);
        $this->users = User::latest()->where('statu', 0)->where('type', 0)->take($this->usersPerPage)->get('*');
        $this->demandeCount = User::where('statu', 0)->where('type', 0)->count();
        $this->usersCount = User::where('statu', 1)->where('type', 0)->count();
    }

    public function refuser($user_id)
    {
        $user = User::find($user_id);
        $user->update([
            'statu' => 2
        ]);
        $this->users = User::latest()->where('statu', 0)->where('type', 0)->take($this->usersPerPage)->get('*');
        $this->demandeCount = User::where('statu', 0)->where('type', 0)->count();
    }

    public function suspendre($user_id)
    {
        $user = User::find($user_id);
        $user->update([
            'statu' => 3
        ]);
        $this->users = User::latest()->where('statu', 1)->where('type', 0)->take($this->usersPerPage)->get('*');
        $this->usersCount = User::where('statu', 1)->where('type', 0)->count();
        $this->suspendCount = User::where('statu', 3)->where('type', 0)->count();
    }

    public function continuer($user_id)
    {
        $user = User::find($user_id);
        $user->update([
            'statu' => 1
        ]);
        $this->users = User::latest()->where('statu', 3)->where('type', 0)->take($this->usersPerPage)->get('*');
        $this->usersCount = User::where('statu', 1)->where('type', 0)->count();
        $this->suspendCount = User::where('statu', 3)->where('type', 0)->count();
    }

    public function render()
    {
        return view('livewire.inscription');
    }
}
