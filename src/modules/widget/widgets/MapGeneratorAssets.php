<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\widget\widgets;


use YiiMan\YiiBasics\lib\AssetBundle;

class MapGeneratorAssets extends AssetBundle
{
    public $sourcePath = '@system/modules/widget/widgets/files';
    public $js =
        [
            'jquery.mapify.js',

        ];
    public $css =
        [
            'jquery.mapify.css',
        ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
