<?php

namespace App\Http\Livewire\Elearning\Modules\Notes;

use App\Models\elearning\EtudientModule;
use App\Models\elearning\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Remplir extends Component
{
    public $module;
    public $apogee = NULL;
    public $noteForm = false;

    protected $listeners = ['clearSearch','closeForm','noteForm'];

    public function clearSearch()
    {
        $this->apogee = '';
    }

    protected $rules = [
        'apogee' => 'required|max:19999999|min:1999999|'
    ];

    protected $messages = [
        'search.max' => 'Apogée non valid.',
        'search.min' => 'Apogée non valid.',
        'search.numeric' => 'Apogée non valid.'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function search()
    {
        //$this->validate();
        $this->emit('findEtudient', $this->apogee);
    }

    public function noteForm()
    {
        $this->noteForm = true;
    }

    public function closeForm()
    {
        $this->noteForm = false;
    }

    public function mount($id)
    {
        $this->module = Module::find($id);
        if ($this->module->enseignant != Auth::id()) {
            return redirect(route('elearning'));
        }
    }
    public function render()
    {
        return view('livewire.elearning.modules.notes.remplir');
    }
}
