<?php

namespace Gcoop\WebServices\Config;

use Gcoop\Cache\CacheFactory;
use Gcoop\WebServices\Middleware\MiddlewareFactory;

final class ConfigFactory
{
    const PATTERN_MISSING_CONFIG = "Falta el valor de '%config' en la configuración del WS '%ws'";
    private static $webservice;

    public static function get(string $webservice, string $current_user) :Config
    {
        self::$webservice = $webservice;
        $config  = self::getWSConfig($webservice);
        $wsFileName = self::getWSFileName();
        $handler = MiddlewareFactory::get((int) $config['cache_lifetime'], $wsFileName, $current_user);
        $config['handler'] = $handler;

        return new Config(self::$webservice, $config);
    }

    private static function getWSConfig(string $webservice) :array
    {
        require 'config_ws.php';

        if (!array_key_exists($webservice, $config_webservices)) {
            throw new \ConfiguracionInexistente("Configuración de WS inexistente");
        }
        $config = $config_webservices[$webservice];
        self::validateConfig($config);

        return $config;
    }

    private static function getWSFileName() :string
    {
        $baseDir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR;
        $logDir  = \SugarConfig::getInstance()->get('log_dir');

        if ($logDir !== null && $logDir !== '.') {
            $baseDir = $logDir.DIRECTORY_SEPARATOR;
        }
        $wsFileName  = $baseDir;
        $wsFileName .= \SugarConfig::getInstance()->get('logger_ws_guzzle.file.name');
        $wsFileName .= \SugarConfig::getInstance()->get('logger_ws_guzzle.file.ext');
        return $wsFileName;
    }


    private static function validateConfig(array $config) :void
    {

        if (empty($config['base_uri'])) {
            throw new \ConfiguracionInexistente(strtr(self::PATTERN_MISSING_CONFIG, ['%config' => 'base_uri', '%ws' => self::$webservice]));
        }

        if (empty($config['uri'])) {
            throw new \ConfiguracionInexistente(strtr(self::PATTERN_MISSING_CONFIG, ['%config' => 'uri', '%ws' => self::$webservice]));
        }

        if (empty($config['cache_lifetime'])) {
            throw new \ConfiguracionInexistente(strtr(self::PATTERN_MISSING_CONFIG, ['%config' => 'cache_lifetime', '%ws' => self::$webservice]));
        }
    }
}
