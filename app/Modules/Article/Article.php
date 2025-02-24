<?php
namespace App\Modules\Article;

use App\Modules\Article\Models\Article as Model;

// Article is a public class that can be accessed in all modules
class Article
{
    public function __construct()
    {
        
    }

    public function getAllBuilder($is_logged_in=true, $category=null, $keyword=null)
    {
        return Model::when(!$is_logged_in, function($qry) {
            $qry->where(function($sub) {
                $sub->where('is_limited', false)->orWhereNull('is_limited');
            });
        })->when($category, function($qry) use($category) {
            $qry->where('category_id', $category);
        })->when($keyword, function($qry) use($keyword) {
            $qry->where('title', 'like', "%".str_replace(' ', '%', $keyword)."%");
        })->where('is_active', true);
    }
}