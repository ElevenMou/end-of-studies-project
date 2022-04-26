<?php

namespace App\Models\elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDocument extends Model
{
    use HasFactory;
    protected $table = 'category_documents';
    protected $fillable = ['titre', 'url', 'category_id'];

    public function category()
    {
        return $this->belongsTo(ModuleCategory::class, 'category_id');
    }
}
