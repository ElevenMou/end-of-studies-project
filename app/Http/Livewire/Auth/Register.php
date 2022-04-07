<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    use WithFileUploads;

    public $identifiant;
    public $prenom;
    public $nom;
    public $filiere;
    public $email;
    public $password;
    public $password_confirmation;
    public $avatar;
    public $path = 'images/avatars/default-avatar.jpg';
    public $session = false;

    protected $rules = [
        'identifiant' => 'required|numeric|max:19999999|min:1999999|unique:users',
        'prenom' => 'required|string|max:30|min:3',
        'nom' => 'required|string|max:30|min:3',
        'filiere' => 'required',
        'email' => 'required|string|email|max:255|unique:users',
        'avatar' => 'image|max:5120|nullable',
        'password' => 'required|string|min:8|confirmed',
    ];

    protected $messages = [
        'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        'email.email' => 'Email est non valid.',
        'identifiant.max' => 'Apogée non valid.',
        'identifiant.min' => 'Apogée non valid.'
    ];

    protected $validationAttributes = [
        'identifiant' => 'apogée',
        'password' => 'mot de passe'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function closeSession()
    {
        $this->session = false;
    }

    public function registerUser()
    {
        $this->validate();
        if ($this->avatar) {
            $extension = $this->avatar->getClientOriginalExtension();
            $name = date('d-m-y').'.'.$extension;
            $this->path =
                $this->avatar->storeAs('images/avatars/' . $this->identifiant, $name, 'public');
        }

        User::create([
            'identifiant' => $this->identifiant,
            'prenom' => $this->prenom,
            'nom' => $this->nom,
            'filiere' => $this->filiere,
            'email' => $this->email,
            'avatar' => $this->path,
            'password' => Hash::make($this->password),
            'type' => 2,
            'statu' => 1,
            'isModerator' => true,

        ]);

        $this->reset();

        $this->session = true;

        session()->flash('success', 'Compte est créer');
    }

    public function showLoginForm()
    {
        $this->emit('showLoginForm');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
