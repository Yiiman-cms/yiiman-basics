<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */


namespace YiiMan\YiiBasics\modules\errors;


use YiiMan\YiiBasics\modules\errors\controllers\DefaultController;
use Yii;
use yii\base\Event;
use yii\helpers\ArrayHelper;

class Module extends \YiiMan\YiiBasics\lib\Module
{
    public $controllerNamespace = 'YiiMan\YiiBasics\modules\errors\controllers';
    public $hasComponent = true;

    public $components =
        [
            'errorHandler' => ['errorAction' => 'errors/default/error']
        ];

    public static function settings()
    {
        return
            [
                'Settings' => function ($form) {
                    return Yii::$app->view->render('@vendor/yiiman/yii-basics/src/modules/errors/views/settings.php',
                        ['form' => $form]
                    );
                }
            ];
    }
}

