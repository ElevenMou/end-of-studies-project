<?php

namespace App\Http\Livewire\Enseignants;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    public $identifiant;
    public $prenom;
    public $nom;
    public $filiere;
    public $email;
    public $password;
    public $password_confirmation;
    public $isModerator = false;
    public $session = false;

    protected $rules = [
        'identifiant' => 'required|numeric|max:19999999|min:1999999|unique:users',
        'prenom' => 'required|string|max:30|min:3',
        'nom' => 'required|string|max:30|min:3',
        'filiere' => 'required',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ];

    protected $messages = [
        'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        'email.email' => 'Email est non valid.',
        'identifiant.max' => 'Matricule non valid.',
        'identifiant.min' => 'Matricule non valid.'
    ];

    protected $validationAttributes = [
        'identifiant' => 'Matricule',
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

    public function createProf()
    {
        User::create([
            'identifiant' => $this->identifiant,
            'prenom' => $this->prenom,
            'nom' => $this->nom,
            'filiere' => $this->filiere,
            'email' => $this->email,
            'type' => 1,
            'statu' => 1,
            'isModerator' => $this->isModerator,
            'password' => Hash::make($this->password)
        ]);

        $this->reset();
        $this->session = true;
        session()->flash('success', 'Enseignant est créer');
        $this->emit('newProf');
    }
    public function render()
    {
        return view('livewire.enseignants.create');
    }
}
