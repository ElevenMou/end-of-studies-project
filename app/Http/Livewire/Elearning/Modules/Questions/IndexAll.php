<?php

namespace App\Http\Livewire\Elearning\Modules\Questions;

use App\Models\elearning\ModuleQuestion;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IndexAll extends Component
{
    public $questions, $module_id;
    public $count = 0, $questionsPerPage = 10;

    protected $listeners = ['refreshQuestions', 'questionDeleted'];

    public function refreshQuestions()
    {
        $this->questions = DB::table('module_questions as Q')
            ->leftJoin('question_reactions as R', 'Q.id', '=', 'R.question_id')
            ->where('Q.module_id', $this->module_id)
            ->selectRaw('Q.id , count(Q.id) as reactions')
            ->groupBy('Q.id')
            ->orderByDesc('reactions')
            ->take($this->questionsPerPage)->get();
        $this->count++;
    }
    public function questionDeleted()
    {
        $this->questions = DB::table('module_questions as Q')
            ->leftJoin('question_reactions as R', 'Q.id', '=', 'R.question_id')
            ->where('Q.module_id', $this->module_id)
            ->selectRaw('Q.id , count(Q.id) as reactions')
            ->groupBy('Q.id')
            ->orderByDesc('reactions')
            ->take($this->questionsPerPage)->get();
        $this->count--;
    }

    public function loadMore()
    {
        $this->questionsPerPage += 10;
        $this->questions = DB::table('module_questions as Q')
            ->leftJoin('question_reactions as R', 'Q.id', '=', 'R.question_id')
            ->where('Q.module_id', $this->module_id)
            ->selectRaw('Q.id , count(Q.id) as reactions')
            ->groupBy('Q.id')
            ->orderByDesc('reactions')
            ->take($this->questionsPerPage)->get();
    }

    public function mount($module_id)
    {
        $this->module_id = $module_id;

        $this->questions = DB::table('module_questions as Q')
            ->leftJoin('question_reactions as R', 'Q.id', '=', 'R.question_id')
            ->where('Q.module_id', $this->module_id)
            ->selectRaw('Q.id , count(Q.id) as reactions')
            ->groupBy('Q.id')
            ->orderByDesc('reactions')
            ->take($this->questionsPerPage)->get();

        $this->count = ModuleQuestion::where('module_id', $module_id)->count();
    }
    public function render()
    {
        return view('livewire.elearning.modules.questions.index-all');
    }
}
