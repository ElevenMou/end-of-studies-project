<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;

    protected $rules = ['email' => 'required|string|email|max:255', 'password' => 'required|string'];
    protected $validationAttributes = [
        'password' => 'mot de passe'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login()
    {
        $this->validate();

        if (Auth::attempt(array('email' => $this->email, 'password' => $this->password))) {
            return redirect(route('home'));
        } else {
            session()->flash('error', 'email and password are wrong.');
        }
    }

    public function showRegisterForm()
    {
        $this->emit('showRegisterForm');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
