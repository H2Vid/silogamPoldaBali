<?php
namespace App\Models;

use App\Base\Models\BaseModel;
use App\Base\Shared\Sluggable;
use App\Modules\Category\Models\Category;


class Subcategory extends BaseModel
{
    protected $fillable =
    [
    'title',
    'category_id',
     'description',
     'image',
     'is_active'

    ];
    public function category()
    {
        return $this->belongsTo(Category::class); // Relasi ke kategori
    }
}