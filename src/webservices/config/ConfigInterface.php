<?php

namespace Gcoop\WebServices\Config;

interface ConfigInterface
{
    public function getURI() :string;
    public function getBaseURI() :string;
    public function getWebServiceName() :string;
    public function getCacheLifeTime() :int;
}
