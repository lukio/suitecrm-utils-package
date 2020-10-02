<?php

namespace Gcoop\Cache;

use Psr\Http\Message\RequestInterface;
use Kevinrob\GuzzleCache\KeyValueHttpHeader;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;

class GcoopGreedyCacheStrategy extends GreedyCacheStrategy
{
    /**
     * Este método genera nuestro propio hash para la key
     * teniendo en cuenta el body del request.
     *
     */
    protected function getCacheKey(RequestInterface $request, KeyValueHttpHeader $varyHeaders = null)
    {
        return hash(
            'sha256',
            'greedy'.$request->getMethod().$request->getUri().$request->getBody()
        );
    }
}
