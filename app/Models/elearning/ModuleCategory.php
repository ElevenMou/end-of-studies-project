<?php

namespace App\Models\elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleCategory extends Model
{
    use HasFactory;

    protected $table = 'module_categories';
    protected $fillable = ['titre', 'module_id'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
    public function documents()
    {
        return $this->hasMany(CategoryDocument::class, 'category_id');
    }
}
