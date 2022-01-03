<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\shop\calculators;

interface CalculatorInterface
{
    /**
     * @param  \YiiMan\YiiBasics\modules\shop\CartItem[]  $items
     * @return integer
     */
    public function getCost(array $items);

    /**
     * @param  \YiiMan\YiiBasics\modules\shop\CartItem[]  $items
     * @return integer
     */
    public function getCount(array $items);
}
