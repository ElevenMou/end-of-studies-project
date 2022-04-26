<?php

namespace App\Http\Livewire\Elearning\Modules\Questions;

use App\Models\elearning\ModuleQuestion;
use Livewire\Component;

class Index extends Component
{
    public $question;

    public function mount(ModuleQuestion $question)
    {
        $this->question = $question;
    }
    public function render()
    {
        return view('livewire.elearning.modules.questions.index');
    }
}
