<?php

namespace App\Models\elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionReaction extends Model
{
    use HasFactory;

    protected $table = 'question_reactions';
    protected $fillable = ['question_id', 'user_id'];
}
