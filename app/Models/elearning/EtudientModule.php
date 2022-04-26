<?php

namespace App\Models\elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtudientModule extends Model
{
    use HasFactory;
    protected $table = 'etudient_modules';
    protected $fillable = ['module_id','user_id','noteN','noteR','session'];

}
