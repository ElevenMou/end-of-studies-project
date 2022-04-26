<?php

namespace App\Http\Livewire\Elearning\Modules;

use App\Models\elearning\EtudientModule;
use App\Models\elearning\Module;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $module;
    public $thumbnail, $titre, $filiere, $semestre, $lock, $password, $description;
    public $path;
    public $session = false;
    public $edit = false;
    public $confirm = false;
    public $inscrir = false;

    protected $rules = [
        'titre' => 'required|string|max:100|min:5',
        'filiere' => 'required',
        'semestre' => 'required',
        'thumbnail' => 'image|max:5120|nullable',
        'description' => 'nullable|string',
        'description' => 'nullable|string|min:5',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit()
    {
        $this->edit = !$this->edit;
    }

    public function saveModule()
    {
        $this->validate();
        if ($this->thumbnail) {
            $extension = $this->thumbnail->getClientOriginalExtension();
            $name = $this->titre . '.' . $extension;
            $this->path =
                $this->thumbnail->storeAs('images/thumbnails/' . Auth::user()->identifiant, $name, 'public');
        }
        $this->module->update([
            'titre' => $this->titre,
            'description' => $this->description,
            'filiere' => $this->filiere,
            'thumbnail' => $this->path,
            'semestre' => $this->semestre,
            'lock' => $this->lock,
            'password' => $this->password,
        ]);

        $this->edit = false;
        $this->emit('refreshModules');
        $this->session = true;
        session()->flash('success', 'Module est modifier');
    }

    /************** DELETE ***************/
    public function deleteModule()
    {
        $this->confirm = !$this->confirm;
    }

    public function confirmDelete()
    {
        $this->module->delete();
        $this->confirm = false;
        $this->emit('refreshModules');
    }

    public function closeSession()
    {
        $this->session = false;
    }

    public function mount(Module $module)
    {
        $this->module = $module;
        $this->titre = $this->module->titre;
        $this->filiere = $this->module->filiere;
        $this->path = $this->module->thumbnail;
        $this->description = $this->module->description;
        $this->semestre = $this->module->semestre;
        $this->lock = $this->module->lock;
        $this->password = $this->module->password;

        $inscr = EtudientModule::where('user_id', Auth::user()->identifiant)
            ->where('module_id', $this->module->id)->count();
        if ($inscr != 0) {
            $this->inscrir = true;
        }
    }

    public function render()
    {
        return view('livewire.elearning.modules.index');
    }
}
