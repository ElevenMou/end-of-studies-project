<?php

namespace App\Http\Livewire\Resources;

use Livewire\Component;
use App\Models\resources\Category;


class IndexCategory extends Component
{
    public $cat;
    public $titre;
    public $newDoc = false;
    public $edit = false;
    public $confirm = false;
    public $session = false;

    protected $listeners = ['refreshCategory'];
    protected $rules = [
        'titre' => 'required|string|max:100|min:2',
    ];

    

    public function refreshCategory()
    {
        $this->cat = Category::find($this->cat->id);
        $this->newDoc = false;
    }

    public function closeSession()
    {
        $this->session = false;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    /* Category */
    public function edit()
    {
        $this->edit = !$this->edit;
    }

    public function updateCat()
    {
        $this->cat->update([
            "titre" => $this->titre
        ]);
        session()->flash('success', 'Categorie est modifier');
        $this->edit = false;
        $this->emit('refreshCat');
    }

    public function delete()
    {
        $this->confirm = !$this->confirm;
    }
    public function confirmDelete()
    {
        session()->flash('success', 'Categorie est supprimer');
        $this->cat->delete();
        $this->emit('refreshCat');
        $this->confirm = false;
    }
        /* DOCUMENTS */
    public function newDocForm()
    {
       $this->newDoc = !$this->newDoc;
    }

    public function mount($cat)
    {
        $this->cat = $cat;
        $this->titre = $cat->titre;
    }
    public function render()
    {
        return view('livewire.resources.index-category');
    }
}
