<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Input extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Components\Input::class;
    }
}
