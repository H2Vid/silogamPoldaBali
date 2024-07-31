<?php
namespace App\Modules\Article\Models;

use App\Base\Models\BaseModel;
use App\Base\Shared\Sluggable;
// use App\Base\Shared\Translateable;

class Article extends BaseModel
{
    use Sluggable;
    // use Translateable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'excerpt',
        'image',
        'is_active',
        'is_limited',
        'sort_no',
    ];

    // public $translate_model = ArticleTranslator::class;

    public function slugTarget()
    {
        return 'title';
    }

    public function slugUrl($path=null)
    {
        return config('app.url') . '/article' . (strlen($path) > 0 ? '/'. $path : '');
    }

}