<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $this->users = DB::table('users as follower')->join('follows', 'follower', '=', 'follower.id')
            ->join('users as following', 'following', '=', 'following.id')
            ->where('following', Auth::id())
            ->select('follower.*')->take($this->usersPerPage)->get();
        $this->pageStatu = 0;
    }

    /* FOLLOWING */

    public function following()
    {
        $this->usersPerPage = 20;
        $this->users = DB::table('users as follower')->join('follows', 'follower', '=', 'follower.id')
            ->join('users as following', 'following', '=', 'following.id')
            ->where('follower', Auth::id())
            ->select('following.*')->take($this->usersPerPage)->get();
        $this->pageStatu = 1;
    }

    public function loadMore()
    {
        $this->usersPerPage = $this->usersPerPage + 20;
        if ($this->pageStatu == 0) {
            $this->users = DB::table('users as follower')->join('follows', 'follower', '=', 'follower.id')
                ->join('users as following', 'following', '=', 'following.id')
                ->where('following', Auth::id())
                ->select('follower.*')->take($this->usersPerPage)->get();
        } elseif ($this->pageStatu == 1) {
            $this->users = DB::table('users as follower')->join('follows', 'follower', '=', 'follower.id')
                ->join('users as following', 'following', '=', 'following.id')
                ->where('follower', Auth::id())
                ->select('following.*')->take($this->usersPerPage)->get();
        }
    }


    public function mount()
    {
        $this->followersCount = DB::table('follows')->where('following', Auth::id())->count();

        $this->followingCount = DB::table('follows')->where('follower', Auth::id())->count();

        $this->users = DB::table('users as follower')->join('follows', 'follower', '=', 'follower.id')
            ->join('users as following', 'following', '=', 'following.id')
            ->where('following', Auth::id())->take($this->usersPerPage)
            ->select('follower.*')->get();
    }

    public function render()
    {
        return view('livewire.users.follow');
    }
}
