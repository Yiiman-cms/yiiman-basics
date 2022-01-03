<?php

/*
 * Copyright (c) 2018-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\redactor\widgets;

use YiiMan\YiiBasics\lib\AssetBundle;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class RedactorAsset extends AssetBundle
{
    public $sourcePath = '@system/widgets/redactor/assets';
    public $depends = ['yii\web\JqueryAsset'];

    public $css =
        [
            'redactor.css'
        ];
    public $js =
        [

            'redactor.js',
            'lang/fa.js',
            'lang/ar.js',

        ];

}
