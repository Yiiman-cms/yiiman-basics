<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\notification;

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

    public $controllerNamespace;


    public static function menus()
    {
        return
            [
                [
                    'title' => 'اطلاعیه ها',
                    'items' =>
                        [
                            [
                                'url'   => 'notification',
                                'title' => 'پیام های ارسالی',
                            ]
                        ]
                ]
            ];
    }

    public static function settings()
    {
        return
            [
                Yii::t('notification', 'مرکز اطلاعیه ها') =>
                    function ($form) {
                        return Yii::$app->view->render('@vendor/yiiman/yii-basics/src/modules/notification/settings/notificationCenter.php',
                            ['form' => $form]);
                    }
            ];
    }

}
