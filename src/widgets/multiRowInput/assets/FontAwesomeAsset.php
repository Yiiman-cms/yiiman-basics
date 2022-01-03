<?php

/**
 * Copyright (c) 2014-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\multiRowInput\assets;

use yii\web\AssetBundle;

/**
 * Class FontAwesomeAsset
 * @package YiiMan\YiiBasics\widgets\multiRowInput\assets
 */
class FontAwesomeAsset extends AssetBundle
{
    public $depends = [
    ];

    public $css = [
        [
            '//use.fontawesome.com/releases/v5.2.0/css/all.css',
            'type'        => 'text/css',
            'integrity'   => 'sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ',
            'crossorigin' => 'anonymous',
            'media'       => 'all',
            'id'          => 'font-awesome',
            'rel'         => 'stylesheet'
        ],
    ];

} 
