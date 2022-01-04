<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\blog;

/**
 * blog module definition class
 */


use Yii;
use yii\helpers\ArrayHelper;

class Module extends \YiiMan\YiiBasics\lib\Module
{
    public $controllerNamespace = 'YiiMan\YiiBasics\modules\blog\controllers';

    public static function menus()
    {
        return
            [
                [
                    'title' => 'وبلاگ',
                    'items' =>
                        [
                            [
                                'title' => 'Article',
                                'url'   => 'blog'
                            ],
                            [
                                'title' => 'کامنت ها',
                                'url'   => 'blog/blog-comment'
                            ],
                        ]
                ]
            ];
    }
}
