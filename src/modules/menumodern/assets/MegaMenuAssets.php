<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\menumodern\assets;


use yii\web\AssetBundle;

class MegaMenuAssets extends \YiiMan\YiiBasics\lib\AssetBundle
{
    public $sourcePath = '@vendor/yiiman/yii-basics/src/modules/menumodern/assets/files/css';

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}