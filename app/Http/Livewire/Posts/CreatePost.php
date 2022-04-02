<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;


class CreatePost extends Component
{
    use WithFileUploads;

    public $contenu, $image, $path = null;
    public $user_id;
    public $session = false;

    protected $rules = [
        'contenu' => 'required|max:1200|min:50',
        'image' => 'image|max:10000|nullable',

    ];

    protected $messages = [
        'contenu.min' => 'La publication contenu doit contenir au moins 50 caractères.',
        'contenu.max' => 'La publication de contenu ne peut contenir plus de 1200 caractères.',
    ];

    public function mount()
    {
        $this->user_id = Auth::id();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function closeSession()
    {
        $this->session = false;
    }

    public function savePost()
    {
        $this->validate();

        if ($this->image) {
            $this->path = $this->image->store('images/posts', 'public');
        }

        Post::create([
            'contenu' => $this->contenu,
            'image' => $this->path,
            'user_id' => $this->user_id
        ]);
        $this->reset([
            'contenu',
            'image'
        ]);
        $this->session = true;
        session()->flash('success', 'Publication est créer');
    }

    public function render()
    {
        return view('livewire.posts.create-post');
    }
}
