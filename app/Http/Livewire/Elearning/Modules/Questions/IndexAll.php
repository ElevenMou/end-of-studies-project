<?php

namespace App\Http\Livewire\Elearning\Modules\Questions;

use App\Models\elearning\ModuleQuestion;
use Livewire\Component;

class IndexAll extends Component
{
    public $questions, $module_id;
    public $count = 0, $questionsPerPage = 10;

    protected $listeners = ['refreshQuestions'];

    public function refreshQuestions()
    {
        $this->questions = ModuleQuestion::where('module_id', $this->module_id)->take($this->questionsPerPage)->get();
        $this->count++;
    }

    public function loadMore()
    {
        $this->questionsPerPage += 10;
        $this->questions = ModuleQuestion::where('module_id', $this->module_id)->take($this->questionsPerPage)->get();
    }

    public function mount($module_id)
    {
        $this->module_id = $module_id;
        $this->questions = ModuleQuestion::where('module_id', $module_id)->take($this->questionsPerPage)->get();
        $this->count = ModuleQuestion::where('module_id', $module_id)->count();
    }
    public function render()
    {
        return view('livewire.elearning.modules.questions.index-all');
    }
}
