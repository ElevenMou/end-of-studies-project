<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use HasFactory;
    protected $table = 'user_documents';
    protected $fillable = ['titre','url','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
