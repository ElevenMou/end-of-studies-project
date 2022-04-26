<?php

namespace App\Http\Livewire\Elearning\Modules;

use App\Models\elearning\EtudientModule;
use App\Models\elearning\Module;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InscrirModule extends Component
{
    public $module;
    public $inscrir = false;
    public $password;
    public $passwordCheck = true;
    public $access = false;

    public function access()
    {
        $this->access = !$this->access;
    }

    public function inscrir()
    {
        if($this->module->password == $this->password){
            EtudientModule::create([
                'module_id' => $this->module->id,
                'user_id' => Auth::id()
            ]);
            $this->inscrir = true;
            $this->access = false;
            $this->emit('refreshModules');
        }else{
            $this->passwordCheck = false;
        }
    }

    public function mount(Module $module)
    {
        $this->module = $module;

        $inscr = EtudientModule::where('user_id', Auth::id())
            ->where('module_id', $this->module->id)->count();
        if ($inscr != 0) {
            $this->inscrir = true;
        }
    }
    public function render()
    {
        return view('livewire.elearning.modules.inscrir-module');
    }
}
