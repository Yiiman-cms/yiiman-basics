<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\language;

/**
 * language module definition class
 */


use Yii;
use yii\helpers\ArrayHelper;
use YiiMan\YiiBasics\lib\Language;

class Module extends \YiiMan\YiiBasics\lib\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace = 'YiiMan\YiiBasics\modules\language\controllers';

    public static function menus()
    {
        return
            [
                [
                    'title' => 'زبان های سایت',
                    'url'   => 'language'
                ]
            ];
    }
}
