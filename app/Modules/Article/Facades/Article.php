<?php
namespace App\Modules\Article\Facades;

use Illuminate\Support\Facades\Facade;

class Article extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Modules\Article\Article::class;
    }
}
