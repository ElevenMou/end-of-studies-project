<?php

namespace App\Models\elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Module extends Model
{
    use HasFactory;
    protected $table = 'modules';
    protected $fillable = ['titre', 'description', 'filiere', 'semestre', 'lock', 'password', 'enseignant', 'thumbnail'];

    public function user()
    {
        return $this->belongsTo(User::class, 'enseignant');
    }

    public function etudients()
    {
        return $this->belongsToMany(User::class, 'etudient_modules', 'module_id', 'user_id');
    }

    public function categories()
    {
        return $this->hasMany(ModuleCategory::class);
    }

    public function questions()
    {
        return $this->hasMany(ModuleQuestion::class);
    }
}
