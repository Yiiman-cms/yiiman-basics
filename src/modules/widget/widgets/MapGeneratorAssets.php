<?php


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
