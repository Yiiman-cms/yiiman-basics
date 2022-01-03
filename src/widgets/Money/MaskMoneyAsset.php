<?php

/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\Money;

use kartik\base\AssetBundle;

/**
 * Asset bundle for the [[MaskMoney]] widget. Includes client assets from
 * [jQuery-maskMoney](https://github.com/plentz/jquery-maskmoney).
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since  1.0
 */
class MaskMoneyAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath(__DIR__.'/assets');
        $this->setupAssets('js', ['js/jquery.maskMoney']);
        parent::init();
    }


}
