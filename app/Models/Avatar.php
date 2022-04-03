<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;
    protected $table = 'avatars';
    protected $fillable = ['path','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
