<?php

namespace App\Http\Livewire\Resources;

use Livewire\Component;
use App\Models\resources\Category;

class CreateCategory extends Component
{
    public $titre;
    public $session = false;

    protected $rules = [
        'titre' => 'required|string|max:100|min:2',
    ];

    public function closeSession()
    {
        $this->session = false;
    }
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createCat()
    {
        $this->validate();
        Category::create([
            'titre' => $this->titre
        ]);
        session()->flash('success', 'Categorie est créer');
        $this->emit('refreshCat');
    }
    public function render()
    {
        return view('livewire.resources.create-category');
    }
}
