<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email , $password;

    protected $rules = ['email' => 'required|string|email|max:255'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login()
    {
        $this->validate();
        Auth::attempt([
            'email' => $this->email,
            'password' =>$this->password
        ]);

        return redirect(route('home'));
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
