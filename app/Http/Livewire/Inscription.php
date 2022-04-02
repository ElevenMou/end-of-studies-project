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
    public $demandeCount;

    public function mount()
    {
        if (Auth::user()->type != 2) {
            return redirect('/');
        }
        $this->users = User::latest()->where('statu', 1)->take($this->usersPerPage)->get('*');
        $this->demandeCount = User::where('statu', 0)->count();
    }

    public function loadMore()
    {
        $this->usersPerPage = $this->usersPerPage + 1;
        if($this->demande){
            $this->users = User::latest()->where('statu', 0)->take($this->usersPerPage)->get('*');
        } else{
            $this->users = User::latest()->where('statu', 1)->take($this->usersPerPage)->get('*');
        }
    }

    public function usersDemande()
    {
        $this->demande = true;
        $this->usersPerPage = 1;
        $this->users = $this->users = User::latest()->where('statu', 0)->take($this->usersPerPage)->get('*');;
    }

    public function indexUsers()
    {
        $this->demande = false;
        $this->usersPerPage = 1;
        $this->users = $this->users = User::latest()->where('statu', 1)->take($this->usersPerPage)->get('*');;
    }
    public function render()
    {
        return view('livewire.inscription');
    }
}
