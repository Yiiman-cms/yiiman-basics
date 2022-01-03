<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\pages\widgets\htmlBuilder\assets;

use Yii;
use yii\web\AssetBundle;

class Assets extends \YiiMan\YiiBasics\lib\AssetBundle
{


    public $sourcePath = '@system/modules/pages/widgets/htmlBuilder/assets/files';
    public $js =
        [
            'js/jquery.hotkeys.js',
            'js/popper.min.js',
            'js/bootstrap.min.js',
            'libs/builder/builder.js',
            'libs/builder/undo.js',
            'libs/builder/inputs.js',
            'libs/builder/components-server.js',
            'libs/builder/components-bootstrap4.js',
            'libs/builder/components-widgets.js',
            'libs/builder/blocks-bootstrap4.js',
            'libs/codemirror/lib/codemirror.js',
            'libs/codemirror/lib/xml.js',
            'libs/codemirror/lib/formatting.js',
            'libs/builder/plugin-codemirror.js',
            'libs/autocomplete/jquery.autocomplete.js',
            'Tippy.js',
        ];
    public $css =
        [
            'tippy.css',
            'css/editor.css',
            'css/line-awesome.css',
            'libs/codemirror/lib/codemirror.css',
            'libs/codemirror/theme/material.css',
        ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
