<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    use HasFactory;
    protected $table = 'comment_likes';
    protected $fillable = ['user_id', 'comment_id'];

    public function comment()
    {
        return $this->belongsTo(PostComment::class, 'comment_id');
    }
}
