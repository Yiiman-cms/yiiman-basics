<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\slug;

/**
 * slug module definition class
 */

use Yii;
use yii\helpers\ArrayHelper;

class Module extends  \YiiMan\YiiBasics\lib\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace='YiiMan\YiiBasics\modules\slug\controllers';

    public static function menus()
    {
        return
        [
            [
                'title' => 'Slug',
                'url'   => 'slug/index'
            ]
        ];
    }
}
