<?php

namespace App\Models\resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'resource_documents';
    protected $fillable = ['titre', 'url', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
