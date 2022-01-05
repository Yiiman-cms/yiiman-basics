<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\CodeMirrorSimple;



use YiiMan\YiiBasics\lib\AssetBundle;

class CodeMirrorSimpleAssets extends AssetBundle
{
    public $sourcePath = '@vendor/yiiman/yii-basics/src/widgets/CodeMirrorSimple/files';
    public $css =
        [
            'codemirror.css',
            'addon/codemirror-colorpicker.css',
            'addon/show-hint.css',
            'theme/default.css',
            'theme/3024-day.css',
            'theme/3024-night.css',
            'theme/abcdef.css',
            'theme/ambiance.css',
            'theme/ayu-dark.css',
            'theme/ayu-mirage.css',
            'theme/base16-dark.css',
            'theme/base16-light.css',
            'theme/bespin.css',
            'theme/blackboard.css',
            'theme/cobalt.css',
            'theme/colorforth.css',
            'theme/darcula.css',
            'theme/dracula.css',
            'theme/duotone-dark.css',
            'theme/duotone-light.css',
            'theme/eclipse.css',
            'theme/elegant.css',
            'theme/erlang-dark.css',
            'theme/gruvbox-dark.css',
            'theme/hopscotch.css',
            'theme/icecoder.css',
            'theme/idea.css',
            'theme/isotope.css',
            'theme/lesser-dark.css',
            'theme/liquibyte.css',
            'theme/lucario.css',
            'theme/material.css',
            'theme/material-darker.css',
            'theme/material-palenight.css',
            'theme/material-ocean.css',
            'theme/mbo.css',
            'theme/mdn-like.css',
            'theme/midnight.css',
            'theme/monokai.css',
            'theme/moxer.css',
            'theme/neat.css',
            'theme/neo.css',
            'theme/night.css',
            'theme/nord.css',
            'theme/oceanic-next.css',
            'theme/panda-syntax.css',
            'theme/paraiso-dark.css',
            'theme/paraiso-light.css',
            'theme/pastel-on-dark.css',
            'theme/railscasts.css',
            'theme/rubyblue.css',
            'theme/seti.css',
            'theme/shadowfox.css',
            'theme/solarized dark.css',
            'theme/solarized light.css',
            'theme/the-matrix.css',
            'theme/tomorrow-night-bright.css',
            'theme/tomorrow-night-eighties.css',
            'theme/ttcn.css',
            'theme/twilight.css',
            'theme/vibrant-ink.css',
            'theme/xq-dark.css',
            'theme/xq-light.css',
            'theme/yeti.css',
            'theme/yonce.css',
            'theme/zenburn.css',
        ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $js =
        [


//            'pk-modal.js',
            'codemirror.js',
            'addon/emmet.min.js',
            'addon/active-line.js',
            'addon/show-hint.js',
            'addon/show-hint.js',
            'addon/anyword-hint.js',
            'addon/closebrackets.js',
            'addon/closetag.js',
            'addon/foldcode.js',
            'addon/foldgutter.js',
            'addon/brace-fold.js',
            'addon/xml-fold.js',
            'addon/indent-fold.js',
            'addon/markdown-fold.js',
            'addon/comment-fold.js',
            'addon/hardwrap.js',
            'addon/lint.js',
            'addon/json-lint.js',
            'addon/css-lint.js',
            'addon/javascript-lint.js',

            'addon/dialog.js',
            'addon/searchcursor.js',
            'addon/search.js',
            'addon/annotatescrollbar.js',
            'addon/matchesonscrollbar.js',
            'addon/jump-to-line.js',
            'addon/codemirror-colorpicker.min.js',
            'addon/formatting.js',

        ];
}
