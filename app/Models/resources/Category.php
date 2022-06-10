<?php

namespace App\Models\resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'resource_categories';
    protected $fillable = ['titre'];

    public function documents()
    {
        return $this->hasMany(Document::class, 'category_id');
    }
}
