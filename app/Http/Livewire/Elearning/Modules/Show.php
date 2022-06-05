<?php

namespace App\Http\Livewire\Elearning\Modules;

use App\Models\elearning\EtudientModule;
use App\Models\elearning\Module;
use App\Models\elearning\ModuleQuestion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public $module;
    public $count = 0;
    public $create = false;
    public $inscrir = false;
    protected $listeners = ['refreshModule', 'refreshQuestions', 'questionDeleted'];

    public function refreshModule()
    {
        $this->module = Module::find($this->module->id);
        $this->inscrir = true;
        $this->create = false;
    }

    public function refreshQuestions()
    {
        $this->count++;
    }

    public function questionDeleted()
    {
        $this->count--;
    }

    public function create()
    {
        $this->create = !$this->create;
    }

    public function mount($id)
    {
        if ((Auth::user()->statu == 1 || Auth::user()->statu == 3) && Auth::user()->type != 2) {
            $this->module = Module::find($id);
            $this->count = $this->module->questions->count();
            $inscr = EtudientModule::where('user_id', Auth::id())
                ->where('module_id', $id)->count();
            if ($inscr != 0) {
                $this->inscrir = true;
            }
        } else {
            return redirect(route('home'));
        }
    }
    public function render()
    {
        return view('livewire.elearning.modules.show');
    }
}
