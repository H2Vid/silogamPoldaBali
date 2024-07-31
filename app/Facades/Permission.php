<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Permission extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Components\Permission::class;
    }
}
