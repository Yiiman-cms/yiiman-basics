<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: ۱۷/۰۴/۲۰۲۰
 * Time: ۰۳:۴۹ قبل‌ازظهر
 */

namespace YiiMan\YiiBasics\widgets\imageSelect;


use YiiMan\YiiBasics\lib\AssetBundle;

class ImageSelectAsset extends AssetBundle
{
    public $sourcePath = '@system/widgets/imageSelect/file';
    public $js =
        [
            'jquery.imgcheckbox.js'
        ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
