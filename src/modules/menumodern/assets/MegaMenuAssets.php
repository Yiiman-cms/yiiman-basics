<?php


namespace YiiMan\YiiBasics\modules\menumodern\assets;


use yii\web\AssetBundle;

class MegaMenuAssets extends \YiiMan\YiiBasics\lib\AssetBundle
{
    public $sourcePath = '@system/modules/menumodern/assets/files/css';

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}