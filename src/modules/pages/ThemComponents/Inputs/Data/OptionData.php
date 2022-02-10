<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/10/2022 AD 09:22
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs\Data;

class OptionData
{
    public $value, $text;

    public function __construct($value, $text)
    {
        $this->value = $value;
        $this->text = $text;
    }
}