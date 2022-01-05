<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\editarea;


use YiiMan\YiiBasics\lib\AssetBundle;

class EditareaAssets extends AssetBundle
{
    public $sourcePath = '@vendor/yiiman/yii-basics/src/widgets/editarea/files';
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
