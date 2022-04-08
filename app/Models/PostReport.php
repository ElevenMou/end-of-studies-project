<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    use HasFactory;
    protected $table = 'post_reports';
    protected $fillable = ['user_id', 'post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
