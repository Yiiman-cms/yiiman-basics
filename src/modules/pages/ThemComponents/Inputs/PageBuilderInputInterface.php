<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/10/2022 AD 07:19
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs;

interface PageBuilderInputInterface
{
    public static function JsExtendCode():string;

    public static function htmlTemplate():string;

}