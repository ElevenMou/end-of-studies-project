<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }
    public function render()
    {
        return view('livewire.home');
    }
}
