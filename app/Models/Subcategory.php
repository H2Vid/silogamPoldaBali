<?php
namespace App\Models;

use App\Base\Models\BaseModel;
use App\Base\Shared\Sluggable;


class Subcategory extends BaseModel
{
    protected $fillable = ['title', 'description', 'image', 'is_active'];

}