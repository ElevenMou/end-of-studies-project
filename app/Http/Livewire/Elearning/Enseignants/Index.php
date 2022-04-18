<?php

namespace App\Http\Livewire\Elearning\Enseignants;

use App\Models\elearning\Module;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $modules;
    public $create = false;

    protected $listeners = ['newModule'];

    public function newModule()
    {
        $this->modules = Module::where('enseignant', Auth::id())->get();
    }

    public function create()
    {
        $this->create = !$this->create;
    }

    public function mount()
    {
        $this->modules = Module::where('enseignant', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.elearning.enseignants.index');
    }
}
