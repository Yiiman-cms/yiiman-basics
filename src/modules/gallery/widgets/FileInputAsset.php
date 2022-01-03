<?php

/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\gallery\widgets;

/**
 * Asset bundle for FileInput Widget
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since  1.0
 */
class FileInputAsset extends BaseAsset
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setupAssets('css', ['css/fileinput']);
        $this->setupAssets('js', ['js/fileinput']);
        parent::init();
    }
}
