<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\toggle\assets;

use yii\web\AssetBundle;

class ToggleAssets extends AssetBundle
{
    public $sourcePath = '@system/widgets/toggle/assets/files';
    public $js =
        [
            'bootstrap2-toggle.min.js'
        ];
    public $css =
        [
            'bootstrap2-toggle.min.css',
        ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
