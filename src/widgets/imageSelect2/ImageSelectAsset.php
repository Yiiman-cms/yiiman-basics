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

namespace YiiMan\YiiBasics\widgets\imageSelect2;


use yii\web\AssetBundle;

class ImageSelectAsset extends AssetBundle
{
    public $sourcePath = '@vendor/yiiman/yii-basics/src/widgets/imageSelect/file';
    public $js =
        [
            'jquery.imgcheckbox.js'
        ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $publishOptions =
        [
            'forceCopy' => YII_DEBUG ? true : false
        ];
}
