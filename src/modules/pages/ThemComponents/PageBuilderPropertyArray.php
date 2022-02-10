<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/10/2022 AD 07:11
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents;

/**
 * @property   PagebuilderComponentProperty[] $properties
 */
class PageBuilderPropertyArray
{
    public array $properties;

    /**
     * @param  PagebuilderComponentProperty[]  $array
     */
    public function __construct(array $array)
    {
        $this->properties = $array;
    }
}