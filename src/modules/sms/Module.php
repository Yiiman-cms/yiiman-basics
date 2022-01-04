<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\sms;

/**
 * hint module definition class
 */

use Yii;
use yii\helpers\ArrayHelper;

class Module extends \YiiMan\YiiBasics\lib\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace = 'YiiMan\YiiBasics\modules\sms';

    public static function menus()
    {
        return
            [
                [
                    'title' => 'پیامک ها',
                    'url'   => 'sms/index'
                ]
            ];
    }

    public static function settings()
    {
        return
            [
                Yii::t('sms', 'تنظیمات پیامک') => function ($form) {
                    return Yii::$app->view->render('@vendor/yiiman/yii-basics/src/modules/sms/settings/smsPanel.php',
                        ['form' => $form]);
                }
            ];
    }
}
