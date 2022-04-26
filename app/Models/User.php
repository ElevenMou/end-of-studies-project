<?php

namespace App\Models;

use App\Models\elearning\Module;
use App\Models\elearning\ModuleQuestion;
use App\Models\elearning\QuestionReaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'identifiant',
        'prenom',
        'nom',
        'filiere',
        'email',
        'password',
        'type',
        'statu',
        'isModerator',
        'avatar',
        'description'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following', 'follower');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower', 'following');
    }

    public function comment()
    {
        return $this->hasMany(PostComment::class);
    }
    public function reports()
    {
        return $this->hasMany(ProfileReport::class);
    }

    public function documents()
    {
        return $this->hasMany(UserDocument::class);
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'etudient_modules', 'user_id', 'module_id');
    }

    public function questions()
    {
        return $this->hasMany(ModuleQuestion::class);
    }

    public function reactions()
    {
        return $this->belongsToMany(User::class, 'question_reactions', 'user_id', 'question_id');
    }

}
