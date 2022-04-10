<?php

namespace App\Http\Livewire\Profile;

use App\Models\UserDocument;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateDocument extends Component
{
    public $user;
    public $title, $url;

    protected $rules = [
        'title' => 'required|max:50|min:5',
        'url' => 'required|url',
    ];

    protected $messages = [
        'title.min' => 'Le titre doit contenir au moins 5 caractères.',
        'contenu.max' => 'Le titre ne peut contenir plus de 50 caractères.',
        'url.url' => "url n'est pas valid."
    ];

    public function createDoc()
    {
        $this->validate();
        UserDocument::create([
            'user_id' => Auth::id(),
            'titre' => $this->title,
            'url' => $this->url
        ]);
        $this->title = '';
        $this->url = '';
        $this->emit('docCreated');
    }

    public function fermer()
    {
        $this->emit('fermer');
    }

    public function mount($user)
    {
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.profile.create-document');
    }
}
