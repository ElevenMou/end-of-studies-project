<?php

namespace App\Http\Livewire\Elearning\Modules\Notes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Show extends Component
{
    public $s1, $s2, $s3, $s4, $s5, $s6;

    public function mount()
    {
        if (Auth::user()->type != 0) {
            return redirect(route('elearning'));
        } else{
            $this->s1 = DB::table('modules AS M')
            ->join('etudient_modules AS Em','M.id', 'Em.module_id')
            ->where('M.semestre', 's1')->where('M.filiere', Auth::user()->filiere)
            ->where('Em.user_id', Auth::id())
            ->selectRaw('M.titre, Em.noteN, Em.noteR, Em.session')->get();

            $this->s2 = DB::table('modules AS M')
            ->join('etudient_modules AS Em','M.id', 'Em.module_id')
            ->where('M.semestre', 's2')->where('M.filiere', Auth::user()->filiere)
            ->where('Em.user_id', Auth::id())
            ->selectRaw('M.titre, Em.noteN, Em.noteR, Em.session')->get();

            $this->s3 = DB::table('modules AS M')
            ->join('etudient_modules AS Em','M.id', 'Em.module_id')
            ->where('M.semestre', 's3')->where('M.filiere', Auth::user()->filiere)
            ->where('Em.user_id', Auth::id())
            ->selectRaw('M.titre, Em.noteN, Em.noteR, Em.session')->get();

            $this->s4 = DB::table('modules AS M')
            ->join('etudient_modules AS Em','M.id', 'Em.module_id')
            ->where('M.semestre', 's4')->where('M.filiere', Auth::user()->filiere)
            ->where('Em.user_id', Auth::id())
            ->selectRaw('M.titre, Em.noteN, Em.noteR, Em.session')->get();

            $this->s5 = DB::table('modules AS M')
            ->join('etudient_modules AS Em','M.id', 'Em.module_id')
            ->where('M.semestre', 's5')->where('M.filiere', Auth::user()->filiere)
            ->where('Em.user_id', Auth::id())
            ->selectRaw('M.titre, Em.noteN, Em.noteR, Em.session')->get();

            $this->s6 = DB::table('modules AS M')
            ->join('etudient_modules AS Em','M.id', 'Em.module_id')
            ->where('M.semestre', 's6')->where('M.filiere', Auth::user()->filiere)
            ->where('Em.user_id', Auth::id())
            ->selectRaw('M.titre, Em.noteN, Em.noteR, Em.session')->get();

        }
    }
    public function render()
    {
        return view('livewire.elearning.modules.notes.show');
    }
}
