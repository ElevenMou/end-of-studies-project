<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Authentification extends Component
{
    public $form = 1;

    protected $listeners = ['showRegisterForm', 'showLoginForm'];

    public function showRegisterForm()
    {
        $this->form = 2;
    }

    public function showLoginForm()
    {
        $this->form = 1;
    }

    public function render()
    {
        return view('livewire.auth.authentification');
    }
}
