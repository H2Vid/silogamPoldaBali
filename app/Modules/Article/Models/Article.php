<?php
namespace App\Modules\Article\Models;

use App\Base\Models\BaseModel;
use App\Base\Shared\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends BaseModel
{
    use Sluggable, HasFactory;

    protected static function newFactory()
    {
        return \Database\Factories\ArticleFactory::new();
    }

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'description',
        'excerpt',
        'image',
        'pdf',
        'is_active',
        'is_limited',
        'sort_no',
    ];

    public function category()
    {
        return $this->belongsTo('App\Modules\Category\Models\Category');
    }

    public function slugTarget()
    {
        return 'title';
    }

    public function slugUrl($path=null)
    {
        return config('app.url') . '/article' . (strlen($path) > 0 ? '/'. $path : '');
    }

}