<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib\hquery\Strategy;

use YiiMan\YiiBasics\lib\hquery\Exception\StrategyUnavailableException;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
interface DiscoveryStrategy
{
    /**
     * Find a resource of a specific type.
     * @param  string  $type
     * @return array The return value is always an array with zero or more elements. Each
     *               element is an array with two keys ['class' => string, 'condition' => mixed].
     * @throws StrategyUnavailableException if we cannot use this strategy.
     */
    public static function getCandidates($type);
}
