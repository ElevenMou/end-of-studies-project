<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;


class IndexUsers extends Component
{
    public $users, $usersPerPage = 1;

    public function mount()
    {
        $this->users = User::latest()->where('statu', 1)->take($this->usersPerPage)->get('*');
        $this->demandeCount = User::where('statu', 0)->count();
    }

    public function loadMore()
    {
        $this->usersPerPage = $this->usersPerPage + 1;
        $this->users = User::latest()->where('statu', 1)->take($this->usersPerPage)->get('*');
    }

    public function render()
    {
        return view('livewire.grs.index-users');
    }
}
