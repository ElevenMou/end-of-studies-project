<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    protected $table = 'follows';
    protected $fillable = ['follower','following'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
