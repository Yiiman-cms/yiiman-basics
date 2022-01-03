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
class MultipleInputAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public function __construct($config = [])
    {
        $config = array_merge([
            'sourcePath' => __DIR__.'/src/',
            'js'         => [
                YII_DEBUG ? 'js/jquery.multipleInput.js' : 'js/jquery.multipleInput.min.js'
            ],
            'css'        => [
                YII_DEBUG ? 'css/multiple-input.css' : 'css/multiple-input.min.css'
            ],
        ], $config);

        parent::__construct($config);
    }


} 
