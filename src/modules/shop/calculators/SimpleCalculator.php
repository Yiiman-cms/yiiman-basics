<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\shop\calculators;

class SimpleCalculator implements CalculatorInterface
{
    /**
     * @param  \YiiMan\YiiBasics\modules\shop\CartItem[]  $items
     * @return integer
     */
    public function getCost(array $items)
    {
        $cost = 0;
        foreach ($items as $item) {
            $cost += $item->getCost();
        }
        return $cost;
    }

    /**
     * @param  \YiiMan\YiiBasics\modules\shop\CartItem[]  $items
     * @return integer
     */
    public function getCount(array $items)
    {
        $count = 0;
        foreach ($items as $item) {
            $count += $item->getQuantity();
        }
        return $count;
    }
}
