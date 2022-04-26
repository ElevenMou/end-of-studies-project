<?php

namespace App\Http\Livewire\Elearning\Modules;

use App\Models\elearning\ModuleCategory;
use Livewire\Component;

class CreateCategory extends Component
{
    public $titre;
    public $module_id;

    protected $rules = [
        'titre' => 'required|string|max:100|min:2',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createCat()
    {
        $this->validate();
        ModuleCategory::create([
            'titre' => $this->titre,
            'module_id' => $this->module_id
        ]);
        $this->emit('refreshModule');
    }

    public function mount($module_id)
    {
        $this->module_id = $module_id;
    }

    public function render()
    {
        return view('livewire.elearning.modules.create-category');
    }
}
