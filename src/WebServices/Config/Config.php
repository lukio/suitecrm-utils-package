<?php

namespace Gcoop\WebServices\Config;

use Gcoop\WebServices\Config\ConfigInterface;

final class Config implements ConfigInterface
{
    private $webservice;
    private $config;

    public function __construct(string $webservice, array $config)
    {
        $this->webservice = $webservice;
        $this->config     = $config;
    }

    public function getConfig() :array
    {
        return $this->config;
    }

    public function getURI() :string
    {
        return $this->config['uri'];
    }

    public function getBaseURI() :string
    {
        return $this->config['base_uri'];
    }

    public function getWebServiceName() :string
    {
        return $this->webservice;
    }

    public function getCacheLifeTime() :int
    {
        return (int) $this->config['cache_lifetime'];
    }

    public function getHeaders() :array
    {
        return $this->config['headers'];
    }

    public function getValueByKey(string $key)
    {
        if(!empty($key)) {
            return $this->config[$key];
        }
        throw new \Exception((string) sprintf('%s is empty', $key));
    }
}
