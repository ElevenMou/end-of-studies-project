<?php

namespace App\Models\elearning;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleQuestion extends Model
{
    use HasFactory;

    protected $table = 'module_questions';
    protected $fillable = ['question', 'module_id', 'user_id'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function reactions()
    {
        return $this->belongsToMany(User::class, 'question_reactions', 'question_id', 'user_id');
    }
    public function reponses()
    {
        return $this->hasMany(QuestionReponse::class, 'question_id');
    }

}
