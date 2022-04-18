<?php

namespace App\Http\Livewire\Elearning\Modules;

use App\Models\elearning\Module;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{
    use WithFileUploads;

    public $thumbnail, $titre, $description;
    public $path = 'images/thumbnails/default-thumbnail.jpg';
    public $session = false;

    protected $rules = [
        'titre' => 'required|string|max:30|min:5',
        'thumbnail' => 'image|max:5120|nullable',
        'description' => 'nullable|string',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveModule()
    {
        $this->validate();
        if($this->thumbnail){
            $extension = $this->thumbnail->getClientOriginalExtension();
            $name = $this->titre.'.'.$extension;
            $this->path =
                $this->thumbnail->storeAs('images/thumbnails/' . Auth::user()->identifiant, $name, 'public');
        }
        Module::create([
            'titre' => $this->titre,
            'description' => $this->description,
            'thumbnail' => $this->path,
            'enseignant' => Auth::id()
        ]);

        $this->emit('newModule');
        $this->reset();
        $this->session = true;
        session()->flash('success', 'Module est créer');
    }

    public function closeSession()
    {
        $this->session = false;
    }

    public function render()
    {
        return view('livewire.elearning.modules.create');
    }
}
