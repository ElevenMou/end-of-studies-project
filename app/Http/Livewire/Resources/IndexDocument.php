<?php

namespace App\Http\Livewire\Resources;

use Livewire\Component;

class IndexDocument extends Component
{
    public $document;
    public $titre, $url;
    public $edit = false;
    public $confirm = false;

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

    public function edit()
    {
        $this->edit = !$this->edit;
    }

    public function updateDoc()
    {
        $this->validate();
        $this->document->update([
            'titre' => $this->titre,
            'url' => $this->url
        ]);
        $this->edit = false;
        $this->emit('refreshCategory');
    }

    public function delete()
    {
        $this->confirm = !$this->confirm;
    }

    public function confirmDelete()
    {
        $this->document->delete();
        $this->confirm = false;
        $this->emit('refreshCategory');
    }

    public function mount($doc)
    {
        $this->document = $doc;
        $this->titre = $this->document->titre;
        $this->url = $this->document->url;
    }

    public function render()
    {
        return view('livewire.resources.index-document');
    }
}
