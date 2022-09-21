<?php

namespace Gcoop\WebServices;

use Gcoop\WebServices\Config\ConfigFactory;
use GuzzleHttp\Client;

final class WebServiceFactory
{
    private $webservice;


    public static function get(string $webservice, string $namespace) :WebServiceInterface
    {
        global $current_user;

        $config     = ConfigFactory::get($webservice, $current_user->user_name);
        $httpClient = new Client($config->getConfig());
        $webservice = $namespace. '\\' .$webservice;
        return new $webservice($httpClient, $config);
    }
}
