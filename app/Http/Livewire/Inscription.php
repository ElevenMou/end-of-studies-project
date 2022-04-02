<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Inscription extends Component
{
    public $search;
    public $users, $usersPerPage = 1;
    public $demande = false;
    public $demandeCount, $usersCount;


    public function mount()
    {
        if (Auth::user()->type != 2) {
            return redirect('/');
        }
        $this->users = User::latest()->where('statu', 1)->where('type', 0)->take($this->usersPerPage)->get('*');
        $this->demandeCount = User::where('statu', 0)->where('type', 0)->count();
        $this->usersCount = User::where('statu', 1)->where('type', 0)->count();
    }

        /************** VOIR PLUS **************/
    public function loadMore()
    {
        $this->usersPerPage = $this->usersPerPage + 1;
        if ($this->demande) {
            $this->users = User::latest()->where('statu', 0)->where('type', 0)->take($this->usersPerPage)->get('*');
        } else {
            $this->users = User::latest()->where('statu', 1)->where('type', 0)->take($this->usersPerPage)->get('*');
        }
    }

        /************** DEMANDE D'INSCRIPTION **************/
    public function usersDemande()
    {
        $this->demande = true;
        $this->usersPerPage = 1;
        $this->users = $this->users = User::latest()->where('statu', 0)->where('type', 0)->take($this->usersPerPage)->get('*');;
    }

        /************** ACTIVE UTILISATEURS **************/
    public function indexUsers()
    {
        $this->demande = false;
        $this->usersPerPage = 1;
        $this->users = $this->users = User::latest()->where('statu', 1)->where('type', 0)->take($this->usersPerPage)->get('*');;
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
    }

    public function render()
    {
        return view('livewire.inscription');
    }
}
