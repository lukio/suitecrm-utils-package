<?php

namespace Gcoop\Log;

use Gmponos\GuzzleLogger\Middleware\LoggerMiddleware;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

final class LogMiddlewareFactory
{

    public static function get(string $wsFileName, string $current_user): LoggerMiddleware
    {
        $logger = new Logger('GCA-webservices');
        $stream = new StreamHandler(
            $wsFileName,
            Logger::DEBUG
        );
        $format = "[%datetime%] [{$current_user}] %message% %context%\n";
        $stream->setFormatter(new LineFormatter($format));
        $logger->pushHandler($stream);
        $handler = new GcoopArrayHandler();
        $middleware = new LoggerMiddleware($logger, $handler);

        return $middleware;
    }
}
