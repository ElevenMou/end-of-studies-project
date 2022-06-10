<?php

namespace App\Http\Livewire\Elearning\Modules\Notes;

use App\Models\elearning\EtudientModule;
use App\Models\elearning\Module;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateOrUpdate extends Component
{
    public $module_id;
    public $apogee, $noteN, $noteR;
    public $user;
    public $session = false;

    protected $rules = [
        'apogee' => 'required|numeric|max:19999999|min:1999999|',
        'noteN' => 'nullable|numeric|max:20|min:0',
        'noteR' => 'nullable|numeric|max:20|min:0'
    ];

    protected $messages = [
        'apogee.max' => 'Apogée non valid.',
        'apogee.min' => 'Apogée non valid.',
        'apogee.numeric' => 'Apogée non valid.',
    ];

    protected $validationAttributes = [
        'noteN' => 'note',
        'noteR' => 'note'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function closeSession()
    {
        $this->session = false;
    }

    public function save()
    {
        $this->validate();
        $usr = User::where('identifiant', '=', $this->apogee)->count();
        /* Etudient not registred */
        if ($usr == 0) {
            $this->session = true;
            session()->flash('danger', 'Etudient n\'est pas trouver');
            /* Etudient registred */
        } else {

            $this->user = User::where('identifiant', '=', $this->apogee)->first();
            $etd = EtudientModule::where('user_id', $this->user->id)->where('module_id', $this->module_id)->count();
            /* Etudient Non inscrir dans module */
            if ($etd == 0) {
                EtudientModule::create([
                    'user_id' => $this->user->id,
                    'module_id' => $this->module_id,
                    'noteN' => $this->noteN,
                    'noteR' => $this->noteR,
                    'session' => 1
                ]);
                $this->session = true;
                $this->emit('refreshNotes');
                $this->apogee = '';
                $this->noteN = '';
                $this->noteR = '';
                session()->flash('success', 'note est sauvgarder');
            } else {
                /* Etudient inscrir dans module */
                $etudient = EtudientModule::where('user_id', $this->user->id)->where('module_id', $this->module_id)->first();
                if ($this->noteN == null && $this->noteR != null) {
                    $etudient->update([
                        'noteR' => $this->noteR,
                        'session' => 2
                    ]);
                    $this->emit('refreshNotes');
                    $this->session = true;
                    $this->apogee = '';
                    $this->noteN = '';
                    $this->noteR = '';
                    session()->flash('success', 'note est sauvgarder');
                } else if ($this->noteN != null && $this->noteR == null) {
                    $etudient->update([
                        'noteN' => $this->noteN,
                    ]);
                    $this->emit('refreshNotes');
                    $this->session = true;
                    $this->apogee = '';
                    $this->noteN = '';
                    $this->noteR = '';
                    session()->flash('success', 'note est sauvgarder');
                } else if ($this->noteN != null && $this->noteR != null) {
                    $etudient->update([
                        'noteN' => $this->noteN,
                        'noteR' => $this->noteR,
                        'session' => 2
                    ]);
                    $this->emit('refreshNotes');
                    $this->session = true;
                    $this->apogee = '';
                    $this->noteN = '';
                    $this->noteR = '';
                    session()->flash('success', 'note est sauvgarder');
                } else {
                    $this->session = true;
                    session()->flash('danger', 'Entrer note');
                }
            }
        }
    }

    public function closeForm()
    {
        $this->emit('closeForm');
    }

    public function mount($module_id)
    {
        $this->module_id = $module_id;
    }

    public function render()
    {
        return view('livewire.elearning.modules.notes.create-or-update');
    }
}
