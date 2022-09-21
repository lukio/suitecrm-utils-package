<?php

namespace Gcoop\Cache;

use Gcoop\Cache\GcoopGreedyCacheStrategy;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\Psr6CacheStorage;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

final class CacheMiddlewareFactory
{
    public static function get($cacheLifeTime) :CacheMiddleware
    {
        $requestCacheFolderName = 'webservices';
        $cacheFolderPath = "{$_SERVER['DOCUMENT_ROOT']}/cache";
        $cache_storage = new Psr6CacheStorage(
            new FilesystemAdapter(
                $requestCacheFolderName,
                $cacheLifeTime,
                $cacheFolderPath
            )
        );
        $middleware = new CacheMiddleware(
            new GcoopGreedyCacheStrategy(
                $cache_storage,
                $cacheLifeTime
            )
        );
        $middleware->setHttpMethods(['GET' => 'GET', 'POST' => 'POST']);
        return $middleware;
    }
}
