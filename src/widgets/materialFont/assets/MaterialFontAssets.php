<?php
/**
 * Copyright (c) 2018-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by PhpStorm.
 * User: amintado
 * Date: 7/24/2018
 * Time: 7:36 PM
 */

namespace YiiMan\YiiBasics\widgets\materialFont\assets;


use yii\web\AssetBundle;

class MaterialFontAssets extends AssetBundle
{
    public $css =
        [
            'css/materialdesignicons.css'
        ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function init()
    {
        parent::init();
        $this->sourcePath = realpath(__DIR__.'/files');
    }

}
