<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Site: https://yiiman.ir
 * AuthorName: gholamreza beheshtian
 * AuthorNumber:+989353466620 | +17272282283
 * AuthorCompany: YiiMan
 */

namespace YiiMan\YiiBasics\modules\sessions;

/**
 * systemlog module definition class
 */


use Yii;
use yii\helpers\ArrayHelper;

class Module extends \YiiMan\YiiBasics\lib\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace = 'YiiMan\YiiBasics\modules\sessions\controllers';
    public $name;
    public $nameSpace;
    public $config = [];
    public $hasComponent = true;
    public $components =
        [
            'log'     => [
                'traceLevel'    => YII_DEBUG ? 1000 : 0,
                'flushInterval' => 3000,
                // default is 1000
                'targets'       =>
                    [
                        [
                            'class'     => \YiiMan\YiiBasics\modules\systemlog\models\DbTarget::class,
                            'logTable'  => 'module_systemlog',
                            'microtime' => true,
                            'levels'    =>
                                [
                                    'error',
                                    //'warning',
                                    //'info'
                                ],
                        ],
                    ],
            ],
            'session' =>
                [
                    'class' => 'YiiMan\YiiBasics\modules\sessions\models\DbSession'
                ]
        ];

    public static function settings()
    {
        return
            [
                Yii::t('sessions', 'تنظیمات نشست های کاربران') => function ($form) {
                    return Yii::$app->view->render('@vendor/yiiman/yii-basics/src/modules/sessions/settings/sessions.php',
                        ['form' => $form]);
                }
            ];
    }

    public static function menus()
    {
        return
            [
                [
                    'title' => 'لاگ های سیستمی',
                    'url'   => 'sessions/index'
                ]
            ];
    }
}
