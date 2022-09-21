<?php

namespace Gcoop\WebServices;

use Gcoop\WebServices\Config\ConfigInterface as ConfigInterface;

interface WebServiceInterface
{
    public function __construct(
        \GuzzleHttp\ClientInterface $httpClient,
        ConfigInterface $config
    );
}
