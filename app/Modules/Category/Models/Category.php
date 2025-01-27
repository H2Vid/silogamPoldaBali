<?php
namespace App\Modules\Category\Models;

use App\Base\Models\BaseModel;
use App\Base\Shared\Sluggable;

class Category extends BaseModel
{
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'is_active',
        'sort_no',
    ];

    public function slugTarget()
    {
        return 'title';
    }

    public function slugUrl($path=null)
    {
        return config('app.url') . '/category' . (strlen($path) > 0 ? '/'. $path : '');
    }

}