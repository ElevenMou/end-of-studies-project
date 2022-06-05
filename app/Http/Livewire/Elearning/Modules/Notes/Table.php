<?php

namespace App\Http\Livewire\Elearning\Modules\Notes;

use App\Models\elearning\EtudientModule;
use App\Models\elearning\Module;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Table extends Component
{
    public $module;
    public $etudients;
    public $search = false;
    public $count, $etudientsPerPage = 20;
    protected $listeners = ['findEtudient', 'refreshNotes'];

    public function findEtudient($apogee)
    {
        $this->search = true;
        $this->etudients = DB::table('etudient_modules AS M')->join('users AS E', 'E.id', '=', 'M.user_id')
            ->where('module_id', $this->module->id)->where('E.identifiant', $apogee)
            ->selectRaw('E.id, E.nom, E.prenom, E.identifiant, M.noteN, M.noteR')->get();
    }

    public function refreshNotes()
    {
        $this->etudients = DB::table('etudient_modules AS M')->join('users AS E', 'E.id', '=', 'M.user_id')
            ->where('module_id', $this->module->id)
            ->selectRaw('E.id, E.nom, E.prenom, E.identifiant, M.noteN, M.noteR')
            ->take($this->etudientsPerPage)->get();
    }

    public function clearSearch()
    {
        $this->search = false;
        $this->etudients = DB::table('etudient_modules AS M')->join('users AS E', 'E.id', '=', 'M.user_id')
            ->where('module_id', $this->module->id)
            ->selectRaw('E.id, E.nom, E.prenom, E.identifiant, M.noteN, M.noteR')
            ->take($this->etudientsPerPage)->get();
        $this->emit('clearSearch');
    }

    public function loadMore()
    {
        $this->etudientsPerPage += 15;
        $this->etudients = DB::table('etudient_modules AS M')->join('users AS E', 'E.id', '=', 'M.user_id')
            ->where('module_id', $this->module->id)
            ->selectRaw('E.id, E.nom, E.prenom, E.identifiant, M.noteN, M.noteR')
            ->take($this->etudientsPerPage)->get();
    }

    public function mount(Module $module)
    {
        $this->module = $module;
        $this->etudients = DB::table('etudient_modules AS M')->join('users AS E', 'E.id', '=', 'M.user_id')
            ->where('module_id', $this->module->id)
            ->selectRaw('E.id, E.nom, E.prenom, E.identifiant, M.noteN, M.noteR')
            ->take($this->etudientsPerPage)->get();
        $this->count = EtudientModule::where('module_id', $this->module->id)->count();
    }

    public function render()
    {
        return view('livewire.elearning.modules.notes.table');
    }
}
