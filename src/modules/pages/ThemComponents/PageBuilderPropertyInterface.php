<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/10/2022 AD 06:43
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents;

interface PageBuilderPropertyInterface
{
    public function title():string;

    public function id():string;

    public function onChangeJsCode():string;

    public function input():PageBuilderBaseInput;
}