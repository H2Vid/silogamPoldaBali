<?php
namespace App\Modules\Banner\Facades;

use Illuminate\Support\Facades\Facade;

class Banner extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Modules\Banner\Banner::class;
    }
}
