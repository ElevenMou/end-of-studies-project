<?php

namespace App\Http\Livewire\Elearning\Modules\Questions;

use App\Models\elearning\QuestionReaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Like extends Component
{
    public $question_id;
    public $count = 0;
    public $up = false, $down = false;

    public function up()
    {
        if(!$this->up){
            $this->up = true;
            $this->count++;
            if($this->down){
                $this->down = false;
                $reaction = QuestionReaction::where('user_id', Auth::id())->where('question_id', $this->question_id);
                $reaction->update([
                    'reaction'=> 1
                ]);
            }else{
                QuestionReaction::create([
                    'question_id' => $this->question_id,
                    'user_id' => Auth::id(),
                    'reaction' => 1
                ]);
            }
        }else{
            $reaction = QuestionReaction::where('user_id', Auth::id())->where('question_id', $this->question_id);
            $reaction->delete();
            $this->up = false;
            $this->count--;
        }

    }

    public function down()
    {
        if(!$this->down){
            $this->down = true;
            if($this->count > 0){
                $this->count--;
            }
            if($this->up){
                $this->up = false;
                $reaction = QuestionReaction::where('user_id', Auth::id())->where('question_id', $this->question_id);
                $reaction->update([
                    'reaction'=> 0
                ]);
            }else{
                QuestionReaction::create([
                    'question_id' => $this->question_id,
                    'user_id' => Auth::id(),
                    'reaction' => 0
                ]);
            }
        } else {
            $reaction = QuestionReaction::where('user_id', Auth::id())->where('question_id', $this->question_id);
            $reaction->delete();
            $this->down = false;
            $this->count++;
        }

    }

    public function mount($question_id)
    {
        $this->question_id = $question_id;
        $this->count = QuestionReaction::where('reaction', 1)->where('question_id', $question_id)->count() -
            QuestionReaction::where('reaction', 0)->where('question_id', $question_id)->count();

        $reacted = QuestionReaction::where('user_id', Auth::id())->where('question_id', $question_id)->count();
        if ($reacted != 0) {
            $react = QuestionReaction::where('user_id', Auth::id())->where('question_id', $this->question_id)->first();
            if ($react->reaction == 0) {
                $this->down = true;
            } elseif ($react->reaction == 1) {
                $this->up = true;
            }
        }
    }

    public function render()
    {
        return view('livewire.elearning.modules.questions.like');
    }
}
