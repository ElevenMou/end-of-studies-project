<?php

namespace App\Http\Livewire\Elearning\Modules\Questions;

use App\Models\elearning\ModuleQuestion;
use Livewire\Component;

class Index extends Component
{
    public $question;

    public function delete($question_id)
    {
        $reponse = ModuleQuestion::find($question_id);
        $reponse->delete();
        $this->emit('questionDeleted');
    }

    public function mount($question_id)
    {
        $this->question = ModuleQuestion::find($question_id);
    }
    public function render()
    {
        return view('livewire.elearning.modules.questions.index');
    }
}
