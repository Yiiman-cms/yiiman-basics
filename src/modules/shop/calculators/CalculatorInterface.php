<?php

namespace YiiMan\YiiBasics\modules\shop\calculators;

interface CalculatorInterface
{
    /**
     * @param \YiiMan\YiiBasics\modules\shop\CartItem[] $items
     * @return integer
     */
    public function getCost(array $items);
    /**
     * @param \YiiMan\YiiBasics\modules\shop\CartItem[] $items
     * @return integer
     */
    public function getCount(array $items);
}
