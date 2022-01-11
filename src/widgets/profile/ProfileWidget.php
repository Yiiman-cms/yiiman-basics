<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 1/11/2022 AD 13:14
 */

namespace YiiMan\YiiBasics\widgets\profile;


use yii\base\Widget;
use YiiMan\YiiBasics\widgets\profile\assets\ProfileAsset;

class ProfileWidget extends Widget
{
    public function init()
    {
        $asset = ProfileAsset::register(\Yii::$app->view);
        echo '<img src="'.$asset->baseUrl.'/man-'.rand(1, 5).'.jpg">';

    }
}