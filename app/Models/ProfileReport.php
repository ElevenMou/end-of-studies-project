<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileReport extends Model
{
    use HasFactory;
    protected $table = 'profile_reports';
    protected $fillable = ['reporter', 'reported'];

    public function user()
    {
        return $this->belongsTo(Post::class, 'reported');
    }
}
