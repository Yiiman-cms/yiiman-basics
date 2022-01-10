<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\useradmin;

/**
 * tour module definition class
 */

use Yii;
use yii\helpers\ArrayHelper;

class Module extends \YiiMan\YiiBasics\lib\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace = 'YiiMan\YiiBasics\modules\useradmin\controllers';


    public static function menus()
    {
        return
            [
                [
                    'title' => 'کاربران ادمین',
                    'icon'  => 'people',
                    'url'   => 'useradmin'
                ]
            ];
    }

    public $urls =
        [
            [
                'pattern'    => 'login',
                'route'      => 'useradmin/login/index',
                'normalizer' =>
                    [
                        // do not collapse consecutive slashes for this rule
                        'collapseSlashes' => false,
                    ],
            ],
            [
                'pattern'    => 'logout',
                'route'      => 'useradmin/login/logout',
                'normalizer' =>
                    [
                        // do not collapse consecutive slashes for this rule
                        'collapseSlashes' => false,
                    ],
            ],

        ];





}
