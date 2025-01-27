<?php
namespace App\Modules\Banner\Models;

use App\Base\Models\BaseModel;

class Banner extends BaseModel
{
    protected $fillable = [
        'title',
        'image',
        'is_active',
        'sort_no',
    ];
}