<?php
namespace App\Modules\Article;

use App\Modules\Article\Models\Article as Model;

// Article is a public class that can be accessed in all modules
class Article
{
    public function __construct()
    {
        
    }

    public function getAllBuilder($is_logged_in=true, $category=null)
    {
        return Model::when(!$is_logged_in, function($qry) {
            $qry->where('is_limited', false);
        })->when($category, function($qry) {
            $qry->where('category_id', $category);
        });
    }
}