<?php

namespace App\Models;

// use App\Models\HasPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Kolom database yang bisa diedit
    protected $fillable = [
        'category_id',
        'image',
        'title',
        'content',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
