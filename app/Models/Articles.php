<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category_id',
        'subcategory_id',
        'slug',
        'excerpt',
        'description',
        'image',
        'is_active',
        'pdf',
        'pdfs'
    ];
    protected $casts = [
        'pdfs' => 'array', // Agar otomatis dikonversi menjadi array saat diambil dari database
    ];
}
