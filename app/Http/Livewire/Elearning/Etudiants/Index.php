<?php

namespace App\Http\Livewire\Elearning\Etudiants;

use App\Models\elearning\EtudientModule;
use App\Models\elearning\Module;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $modules, $modulesInsctit;

    protected $listeners = ['refreshModules', 'refreshModule'];

    public function refreshModules()
    {
        $this->modulesInsctit = Auth::user()->modules;
    }

    public function refreshModule()
    {
        $this->modulesInsctit = Auth::user()->modules;
    }

    public function mount()
    {
        $this->modules = Module::where('filiere', Auth::user()->filiere)->get();
        $this->modulesInsctit = Auth::user()->modules;
    }
    public function render()
    {
        return view('livewire.elearning.etudiants.index');
    }
}
