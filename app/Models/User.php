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

    public function followers()
    {
        return $this->belongToMany(Follow::class, 'followe', 'follower', 'following');
    }

    public function following()
    {
        return $this->hasMany(Follow::class, 'following');
    }

}
