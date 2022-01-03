<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib\curl;

use yii\base\Component;

class StringUtil extends Component
{
    /**
     * Return true when $haystack starts with $needle.
     * @access public
     * @param  $haystack
     * @param  $needle
     * @return bool
     */
    public static function startsWith($haystack, $needle)
    {
        return \mb_substr($haystack, 0, \mb_strlen($needle)) === $needle;
    }
}
