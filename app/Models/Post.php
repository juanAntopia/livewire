<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'content',
        'image_path',
        'is_published'
    ];

    // Relación uno a muchos inversa
    public function category () {
        return $this->belongsToMany(Category::class);
    }

    //Relación muchos a muchos
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
