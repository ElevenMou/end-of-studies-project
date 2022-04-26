<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Follow extends Component
{
    public $pageStatu = 0; //0=followers 1=following 2=search
    public $user;
    public $usersPerPage = 20;
    public $followingCount, $followersCount;

    /* FOLLOWERS */

    public function followers()
    {
        $this->usersPerPage = 20;
        $this->users = Auth::user()->followers->take($this->usersPerPage);
        $this->pageStatu = 0;
    }

    /* FOLLOWING */

    public function following()
    {
        $this->usersPerPage = 20;
        $this->users = Auth::user()->followings->take($this->usersPerPage);
        $this->pageStatu = 1;
    }

    public function loadMore()
    {
        $this->usersPerPage = $this->usersPerPage + 20;
        if ($this->pageStatu == 0) {
            $this->users = Auth::user()->followers->take($this->usersPerPage);
        } elseif ($this->pageStatu == 1) {
            $this->users = Auth::user()->followings->take($this->usersPerPage);
        }
    }


    public function mount()
    {
        $this->followersCount = Auth::user()->followers->count();

        $this->followingCount = Auth::user()->followings->count();

        $this->users = Auth::user()->followers->take($this->usersPerPage);
    }

    public function render()
    {
        return view('livewire.users.follow');
    }
}
