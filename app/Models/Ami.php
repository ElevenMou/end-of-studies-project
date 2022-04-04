<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ami extends Model
{
    use HasFactory;
    protected $table = 'amis';
    protected $fillable = ['user1','user2'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
