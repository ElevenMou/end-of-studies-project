<?php

namespace App\Models;

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

}
