<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib\hquery;

use YiiMan\YiiBasics\lib\hquery\Exception\DiscoveryFailedException;
use Http\Message\UriFactory;

/**
 * Finds a URI Factory.
 * @author David de Boer <david@ddeboer.nl>
 */
final class UriFactoryDiscovery extends ClassDiscovery
{
    /**
     * Finds a URI Factory.
     * @return UriFactory
     * @throws Exception\NotFoundException
     */
    public static function find()
    {
        try {
            $uriFactory = static::findOneByType(UriFactory::class);
        } catch (DiscoveryFailedException $e) {
            throw new NotFoundException(
                'No uri factories found. To use Guzzle, Diactoros or Slim Framework factories install php-http/message and the chosen message implementation.',
                0,
                $e
            );
        }

        return static::instantiateClass($uriFactory);
    }
}
