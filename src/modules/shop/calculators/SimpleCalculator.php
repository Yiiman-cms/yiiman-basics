<?php

namespace YiiMan\YiiBasics\modules\shop\calculators;

class SimpleCalculator implements CalculatorInterface
{
    /**
     * @param \YiiMan\YiiBasics\modules\shop\CartItem[] $items
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
     * @param \YiiMan\YiiBasics\modules\shop\CartItem[] $items
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
