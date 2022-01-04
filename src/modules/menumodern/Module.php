<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\menumodern;

/**
 * menu module definition class
 */


use Yii;
use yii\helpers\ArrayHelper;

class Module extends \YiiMan\YiiBasics\lib\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace = 'YiiMan\YiiBasics\modules\menumodern\controllers';

    public static function menus()
    {
        return
            [
                [
                    'title' => 'منوی مدرن',
                    'url'   => 'menusmodern'
                ]
            ];
    }

}
