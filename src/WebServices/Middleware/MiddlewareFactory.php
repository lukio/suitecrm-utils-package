<?php

namespace Gcoop\WebServices\Middleware;

use Gcoop\Cache\CacheMiddlewareFactory;
use GuzzleHttp\HandlerStack;
use Gcoop\Log\LogMiddlewareFactory;

final class MiddlewareFactory
{
    public static function get(int $cacheLifeTime, string $wsFileName, string $current_user)
    {
        $stack = HandlerStack::create();
        $cache = CacheMiddlewareFactory::get($cacheLifeTime);
        $log   = LogMiddlewareFactory::get($wsFileName, $current_user);

        $stack->push($cache, 'greedy-cache');
        $stack->push($log, 'webservices_logger');
        return $stack;
    }
}
