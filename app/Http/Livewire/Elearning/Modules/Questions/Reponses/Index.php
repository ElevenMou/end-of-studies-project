<?php

namespace App\Http\Livewire\Elearning\Modules\Questions\Reponses;

use App\Models\elearning\ModuleQuestion;
use App\Models\elearning\QuestionReponse;
use Livewire\Component;

class Index extends Component
{
    public $reponses;
    public $question;

    protected $listeners = ['refreshReponses'];

    public function refreshReponses()
    {
        $this->reponses = QuestionReponse::where('question_id', $this->question->id)->get();
    }

    public function delete($reponse_id)
    {
        $reponse = QuestionReponse::find($reponse_id);
        $reponse->delete();
        $this->reponses = QuestionReponse::where('question_id', $this->question->id)->get();
    }

    public function mount($question_id)
    {
        $this->question = ModuleQuestion::find($question_id);
        $this->reponses = QuestionReponse::where('question_id', $question_id)->get();
    }
    public function render()
    {
        return view('livewire.elearning.modules.questions.reponses.index');
    }
}
