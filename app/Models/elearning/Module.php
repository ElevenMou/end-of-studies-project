<?php

namespace App\Models\elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Module extends Model
{
    use HasFactory;
    protected $table = 'modules';
    protected $fillable = ['titre','description','enseignant','thumbnail'];

    public function user()
    {
        return $this->belongsTo(User::class, 'enseignant');
    }

}
