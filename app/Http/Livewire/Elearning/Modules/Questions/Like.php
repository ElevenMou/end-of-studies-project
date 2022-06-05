<?php

namespace App\Http\Livewire\Elearning\Modules\Questions;

use App\Models\elearning\QuestionReaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Like extends Component
{
    public $question_id;
    public $count = 0;
    public $up = false;

    public function up()
    {
        if (!$this->up) {
            $this->up = true;
            $this->count++;
            QuestionReaction::create([
                'question_id' => $this->question_id,
                'user_id' => Auth::id(),
            ]);
        } else {
            $reaction = QuestionReaction::where('user_id', Auth::id())->where('question_id', $this->question_id);
            $reaction->delete();
            $this->up = false;
            $this->count--;
        }
    }

    public function mount($question_id)
    {
        $this->question_id = $question_id;
        $this->count = QuestionReaction::where('question_id', $question_id)->count();

        $reacted = QuestionReaction::where('user_id', Auth::id())->where('question_id', $question_id)->count();
        if ($reacted != 0) {
            $this->up = true;
        }
    }

    public function render()
    {
        return view('livewire.elearning.modules.questions.like');
    }
}
