<?php

namespace App\Http\Livewire\Parts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Nav extends Component
{
    public $user;


    public function logout()
    {
        Auth::logout();
        return redirect(route('authentification'));
    }

    public function mount()
    {
        if (Auth::check()) {
            $this->user = Auth::user();
        }
    }

    public function render()
    {
        return view('livewire.parts.nav');
    }
}
