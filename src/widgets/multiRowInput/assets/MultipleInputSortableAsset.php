<?php

/**
 * Copyright (c) 2014-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\multiRowInput\assets;

use yii\web\AssetBundle;

/**
 * Class MultipleInputAsset
 * @package YiiMan\YiiBasics\widgets\multiRowInput\assets
 */
class MultipleInputSortableAsset extends AssetBundle
{
    public $depends = [
        'YiiMan\YiiBasics\widgets\multiRowInput\assets\MultipleInputAsset',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__.'/src/';

        $this->js = [
            YII_DEBUG ? 'js/jquery-sortable.js' : 'js/jquery-sortable.min.js'
        ];

        $this->css = [
            YII_DEBUG ? 'css/sorting.css' : 'css/sorting.min.css'
        ];

        parent::init();
    }
} 
