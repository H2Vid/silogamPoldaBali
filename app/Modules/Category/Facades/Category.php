<?php
namespace App\Modules\Category\Facades;

use Illuminate\Support\Facades\Facade;

class Category extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Modules\Category\Category::class;
    }
}
