<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib\hquery;

use Http\Client\HttpClient;
use YiiMan\YiiBasics\lib\hquery\Exception\DiscoveryFailedException;

/**
 * Finds an HTTP Client.
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class HttpClientDiscovery extends ClassDiscovery
{
    /**
     * Finds an HTTP Client.
     * @return HttpClient
     * @throws Exception\NotFoundException
     */
    public static function find()
    {
        try {
            $client = static::findOneByType(HttpClient::class);
        } catch (DiscoveryFailedException $e) {
            throw new NotFoundException(
                'No HTTPlug clients found. Make sure to install a package providing "php-http/client-implementation". Example: "php-http/guzzle6-adapter".',
                0,
                $e
            );
        }

        return static::instantiateClass($client);
    }
}
