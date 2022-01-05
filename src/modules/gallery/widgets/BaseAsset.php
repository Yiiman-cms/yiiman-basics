<?php

/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\gallery\widgets;

use kartik\base\AssetBundle;

/**
 * BaseAsset is the base asset bundle class used by all FileInput widget asset bundles.
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since  1.0
 */
class BaseAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/yiiman/yii-basics/src/modules/gallery/widgets/bootstrap-fileinput';

    public function __construct($config = [])
    {

        $this->publishOptions =
            [
                'forceCopy' => YII_DEBUG ? true : false
            ];
        parent::__construct($config);
    }
}
