<?php

namespace App\Http\Livewire\Parts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Nav extends Component
{
    public $user, $showMenu;

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    public function toggleMenu()
    {
        $this->showMenu = !$this->showMenu;
    }

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.parts.nav');
    }
}
