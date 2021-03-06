<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\shop;

class CartItem
{
    /**
     * @var object $product
     */
    private $product;
    /**
     * @var integer $quantity
     */
    private $quantity;
    /**
     * @var array $params Custom configuration params
     */
    private $params;

    public function __construct($product, $quantity, array $params)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->params = $params;
    }

    /**
     * Returns the id of the item
     * @return integer
     */
    public function getId()
    {
        return $this->product->{$this->params['productFieldId']};
    }

    /**
     * Returns the product, AR model
     * @return object
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Returns the cost of the item
     * @return integer|float
     */
    public function getCost()
    {
        return ceil($this->getPrice() * $this->quantity);
    }

    /**
     * Returns the price of the item
     * @return integer|float
     */
    public function getPrice()
    {
        return $this->product->{$this->params['productFieldPrice']};
    }

    /**
     * Returns the quantity of the item
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Sets the quantity of the item
     * @param  integer  $quantity
     * @return void
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}
