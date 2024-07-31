<?php

namespace App\Logger;

use Exception;
use Blade;
use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Http;

/**
 * Class TelegramHandler
 * @package App\Logging
 */
class TelegramLoggerHandler extends AbstractProcessingHandler
{
    /**
     * Logger config
     * 
     * @var array
     */
    private $config;

    /**
     * Bot API token
     *
     * @var string
     */
    private $botToken;

    /**
     * Chat id for bot
     *
     * @var int
     */
    private $chatId;

    /**
     * Application name
     *
     * @string
     */
    private $appName;

    /**
     * Application environment
     *
     * @string
     */
    private $appEnv;

    /**
     * TelegramHandler constructor.
     * @param int $level
     */
    public function __construct(array $config)
    {
        $level = Logger::toMonologLevel($config['level']);
        parent::__construct($level, true);
    }

    /**
     * @param array $record
     */
    public function write(array $record): void
    {
        // trying to make request and send notification
        try {
            $raw_err = $this->formatText($record);
            if (strlen($raw_err) > 0) {
                $textChunks = str_split($raw_err, 4096);
                foreach ($textChunks as $textChunk) {
                    $sender = new TelegramSender;
                    $sender->sendMessage($textChunk);
                }
            }
        } catch (Exception $exception) {
            \Log::channel('single')->error($exception->getMessage());
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter(): FormatterInterface
    {
        return new LineFormatter("%message% %context% %extra%\n", null, false, true);
    }

    /**
     * @param array $record
     * @return string
     */
    private function formatText(array $record): string
    {
        $base_path = base_path();
        $exception = $record['context']['exception'] ?? null;
        $printed = '<b>'.config('app.name').'</b>';

        $current_url = url()->current() ?? null;
        $ip = request()->ip() ?? null;
        $request = request()->all();

        if ($current_url) {
            $printed .= "\n<b>URL : ". $current_url ."</b>";
        }
        if ($ip) {
            $printed .= "\n IP : " . $ip;
        }
        if (!empty($request)) {
            $req = [];
            foreach ($request as $fld => $val) {
                if (empty($val)) {
                    continue;
                }
                if (is_array($val) || is_object($val)) {
                    $val = json_encode($val);
                }

                if (strlen($val) > 100) {
                    $val = substr($val, 0, 100).'...';
                }
                $req[$fld] = $val;
            }

            $req = json_encode($req);
            $printed .= "\n Request : " . $req;
        }

        if (!$exception) {
            if (isset($record['formatted'])) {
                $printed .= "\n\n<b>ERROR LOG TRIGGERED</b> : \n" . $record['formatted'];

                return $printed;
            }
            return '';
        }

        $has_trace = false;

        if (method_exists($exception, 'getMessage')) {
            $printed .= "\n<b>".$exception->getMessage()."</b>";
            $has_trace = true;
        }
        if (method_exists($exception, 'getFile')) {
            $printed .= "\nFile : " . str_replace($base_path, '', $exception->getFile());
            $has_trace = true;
        }
        if (method_exists($exception, 'getLine')) {
            $printed .= "\nLine : " . $exception->getLine();
            $has_trace = true;
        }
        if (method_exists($exception, 'getTrace')) {
            $traces = $exception->getTrace();
            $max_trace = 5;
            if (isset($traces[0])) {
                $printed .= "\n\nStacktraces : ";
            }
            for ($i=0; $i<$max_trace; $i++) {
                if (isset($traces[$i]['file']) && isset($traces[$i]['line'])) {
                    $printed .= "\n- " . str_replace($base_path, '', $traces[$i]['file']) . ":" . $traces[$i]['line'];
                    $has_trace = true;
                }
            }
        }

        if ($has_trace) {
            return $printed;
        }
        return "";

        // return sprintf("<b>%s</b> (%s)\n%s", $this->appName, $record['level_name'], $record['formatted']);
    }


}