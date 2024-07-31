<?php
namespace App\Logger;

use Http;
use Exception;

class TelegramSender 
{
    /**
     * @param  string  $text
     */
    public function sendMessage(string $text, $silent = true): void
    {
        $endpoint = config('logging.channels.telegram.endpoint') . config('logging.channels.telegram.token') . '/sendMessage?';
        $param = [
            'chat_id' => config('logging.channels.telegram.chat_id'),
            'text' => $text,
            'parse_mode' => 'html',
        ];

        $data = http_build_query($param);
        try {
            $hit = Http::timeout(2)->post($endpoint . $data);
        } catch (Exception $e) {
            if (!$silent) {
                throw $e;
            }
        }
    }
}