<?php

namespace App\Models\elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionReponse extends Model
{
    use HasFactory;
    protected $table = 'question_reponses';
    protected $fillable = ['question_id', 'reponse'];

    public function question()
    {
        return $this->belongsTo(ModuleQuestion::class, 'question_id');
    }

}
