<?php

namespace App\Http\Livewire\Profile;

use App\Models\UserDocument;
use Livewire\Component;

class Documents extends Component
{
    public $docs, $user;
    public $create = false;

    protected $listeners = ['docCreated','fermer'];

    public function docCreated()
    {
        $this->create = false;
        $this->docs = UserDocument::where('user_id', $this->user->id)->get();
    }

    public function fermer()
    {
        $this->create = false;
    }

    public function create()
    {
        $this->create = !$this->create;
    }

    public function delete($doc_id)
    {
        $doc = UserDocument::find($doc_id);
        $doc->delete();
        $this->docs = UserDocument::where('user_id', $this->user->id)->get();
    }

    public function mount($user)
    {
        $this->docs = UserDocument::where('user_id', $user->id)->get();
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.profile.documents');
    }
}
