<?php

namespace App\Http\Livewire\Elearning\Modules\Questions;

use App\Models\elearning\ModuleQuestion;
use Livewire\Component;

class Delete extends Component
{
    public $question_id;

    public function delete()
    {
        $reponse = ModuleQuestion::find($this->question_id);
        $reponse->delete();
        $this->emit('questionDeleted');
    }

    public function mount($question_id)
    {
        $this->question_id = $question_id;
    }
    public function render()
    {
        return view('livewire.elearning.modules.questions.delete');
    }
}
