<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $user, $postsType = 2;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function amisPosts()
    {
        $this->postsType = 0;
    }
    public function profPosts()
    {
        $this->postsType = 1;
    }
    public function adminPosts()
    {
        $this->postsType = 2;
    }

    public function render()
    {
        return view('livewire.home');
    }
}
