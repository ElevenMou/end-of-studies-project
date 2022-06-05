<?php

namespace App\Http\Livewire\Elearning\Modules;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ModulesInscrit extends Component
{
    public $modules;

    protected $listeners = ['refreshModules'];

    public function refreshModules()
    {
        $this->modules = Auth::user()->modules;
    }

    public function mount()
    {
        $this->modules = Auth::user()->modules;
    }

    public function render()
    {
        return view('livewire.elearning.modules.modules-inscrit');
    }
}
