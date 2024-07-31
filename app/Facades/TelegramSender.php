<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class TelegramSender extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Logger\TelegramSender::class;
    }
}
