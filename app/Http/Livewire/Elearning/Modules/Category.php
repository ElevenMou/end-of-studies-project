<?php

namespace App\Http\Livewire\Elearning\Modules;

use App\Models\elearning\ModuleCategory;
use Livewire\Component;

class Category extends Component
{
    public $category, $titre;
    public $edit = false, $confirm = false;
    public $create = false;

    protected $listeners = ['refreshCategory'];
    protected $rules = [
        'titre' => 'required|string|max:100|min:2',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function refreshCategory()
    {
        $this->create = false;
        $this->category = ModuleCategory::find($this->category->id);

    }

    public function edit()
    {
        $this->edit = !$this->edit;
    }

    public function save()
    {
        $this->validate();
        $this->category->update([
            'titre' => $this->titre
        ]);
        $this->edit = false;
        $this->emit('refreshModule');
    }

    public function delete()
    {
        $this->confirm = !$this->confirm;
    }

    public function confirmDelete()
    {
        $this->category->delete();
        $this->confirm = false;
        $this->emit('refreshModule');
    }

    public function create()
    {
        $this->create = !$this->create;
    }

    public function mount(ModuleCategory $category)
    {
        $this->category = $category;
        $this->titre = $this->category->titre;
    }

    public function render()
    {
        return view('livewire.elearning.modules.category');
    }
}
