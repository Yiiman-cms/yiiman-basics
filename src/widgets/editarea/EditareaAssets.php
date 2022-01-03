<?php


namespace YiiMan\YiiBasics\widgets\editarea;


use YiiMan\YiiBasics\lib\AssetBundle;

class EditareaAssets extends AssetBundle
{
    public $sourcePath = '@system/widgets/editarea/files';
    public $js =
        [
            'edit_area_loader.js',
            'edit_area.js',
            'edit_area_full.js',
            'edit_area_functions.js',

            'reg_syntax.js',
//            'autocompletion.js',



            'elements_functions.js',
            'highlight.js',
            'keyboard.js',
            'manage_area.js',
            'regexp.js',
            'resize_area.js',
            'search_replace.js',
        ];
    public $css =
        [
            'edit_area.css',
        ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
