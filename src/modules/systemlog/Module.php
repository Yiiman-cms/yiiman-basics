<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\systemlog;

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

    public $controllerNamespace = 'YiiMan\YiiBasics\modules\systemlog\controllers';


    public $components =
        [
            'log' =>
                [
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
                ]
        ];

    public static function menus()
    {
        return
            [
                [
                    'title' => 'لاگ های سیستمی',
                    'url'   => 'systemlog/index'
                ]
            ];
    }

    public static function settings()
    {
        return
            [
                Yii::t('systemlog', 'تنظیمات خطایابی') => function ($form, $model) {
                    return Yii::$app->view->render('@vendor/yiiman/yii-basics/src/modules/systemlog/settings/LogSettings.php',
                        [
                            'form'  => $form,
                            'model' => $model
                        ]
                    );
                }
            ];
    }
}
