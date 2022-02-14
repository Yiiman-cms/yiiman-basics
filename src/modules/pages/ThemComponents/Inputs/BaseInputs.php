<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/7/2022 AD 21:40
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs;

/**
 * @property string $htmlAttributeName
 * @property string $onChange
 */
abstract class BaseInputs implements PageBuilderInputInterface
{
    public string $onChange;
    public string $htmlAttributeName;

    const HTTP_ATTR_CLASS = 'class';
    const HTTP_ATTR_STYLE = 'style';
    const HTTP_ATTR_HTML = 'innerHTML';
}