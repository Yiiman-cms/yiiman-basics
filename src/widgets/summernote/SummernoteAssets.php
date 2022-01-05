<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\summernote;

use yii\web\AssetBundle;

class SummernoteAssets extends \YiiMan\YiiBasics\lib\AssetBundle
{
    public $sourcePath = '@vendor/yiiman/yii-basics/src/widgets/summernote/files';
    public $js =
        [
            'summernote.min.js'
        ];
    public $css =
        [
            'summernote.min.css',
        ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
