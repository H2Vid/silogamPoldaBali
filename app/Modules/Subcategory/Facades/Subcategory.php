<?php
namespace App\Modules\Subcategory\Facades;

use Illuminate\Support\Facades\Facade;

class Subcategory extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Modules\Subcategory\Subcategory::class;
    }
}
