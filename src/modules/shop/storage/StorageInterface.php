<?php

namespace YiiMan\YiiBasics\modules\shop\storage;

interface StorageInterface
{
    /**
     * @param array $params (configuration params)
     */
    public function __construct(array $params);
    /**
     * @return \YiiMan\YiiBasics\modules\shop\models\CartItem[]
     */
    public function load();
    /**
     * @param \YiiMan\YiiBasics\modules\shop\models\CartItem[] $items
     */
    public function save(array $items);
}
