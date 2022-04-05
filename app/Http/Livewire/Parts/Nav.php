<?php

namespace App\Http\Livewire\Parts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Nav extends Component
{
    public $user;

    protected $listeners = [''];

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
