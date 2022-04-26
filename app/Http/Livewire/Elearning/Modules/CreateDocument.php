<?php

namespace App\Http\Livewire\Elearning\Modules;

use App\Models\elearning\CategoryDocument;
use Livewire\Component;

class CreateDocument extends Component
{
    public $titre, $url;
    public $category_id;

    protected $rules = [
        'titre' => 'required|string|max:100|min:2',
        'url' => 'required|url',
    ];

    protected $messages = [
        'url.url' => 'Le format de l\'URL n\'est pas valide.'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createDoc()
    {
        $this->validate();
        CategoryDocument::create([
            'titre' => $this->titre,
            'url' => $this->url,
            'category_id' => $this->category_id
        ]);
        $this->emit('refreshCategory');
    }


    public function mount($category_id)
    {
        $this->category_id = $category_id;
    }
    public function render()
    {
        return view('livewire.elearning.modules.create-document');
    }
}
