<?php

namespace App\Http\Livewire\Elearning\Modules\Questions\Reponses;

use App\Models\elearning\QuestionReponse;
use Livewire\Component;

class Create extends Component
{
    public $reponse;
    public $question_id;

    protected $rules = [
        'reponse' => 'required|string|max:600|min:15',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->validate();
        QuestionReponse::create([
            'reponse' => $this->reponse,
            'question_id' => $this->question_id,
        ]);
        $this->emit('refreshReponses');
        $this->reset();
    }

    public function mount($question_id)
    {
        $this->question_id = $question_id;
    }
    public function render()
    {
        return view('livewire.elearning.modules.questions.reponses.create');
    }
}
