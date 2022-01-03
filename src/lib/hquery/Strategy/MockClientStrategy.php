<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib\hquery\Strategy;

use Http\Client\HttpClient;
use Http\Mock\Client as Mock;

/**
 * Find the Mock client.
 * @author Sam Rapaport <me@samrapdev.com>
 */
final class MockClientStrategy implements DiscoveryStrategy
{
    /**
     * {@inheritdoc}
     */
    public static function getCandidates($type)
    {
        return (HttpClient::class === $type)
            ? [
                [
                    'class' => Mock::class,
                    'condition' => Mock::class
                ]
            ]
            : [];
    }
}
