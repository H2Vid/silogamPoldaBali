<?php
namespace App\Modules\SubCategory\Facades;

use Illuminate\Support\Facades\Facade;

class Subcategory extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Modules\SubCategory\Subcategory::class;
    }
}
