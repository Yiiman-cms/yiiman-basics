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


use YiiMan\YiiBasics\modules\errors\Module;
use YiiMan\YiiBasics\modules\setting\controllers\DefaultController;
use yii\base\Event;

Event::on(DefaultController::className(), 'setting', function () {
    include_once realpath(__DIR__.'/views/settings.php');
});

if (realpath(__DIR__.'/../setting/components/Options.php')) {
    $components['errorHandler'] = ['errorAction' => 'errors/default/error'];
}


return
    [
        'type'           => ['common'],
        'namespace'      => 'YiiMan\YiiBasics\modules\errors',
        'sourceLanguage' => 'fa',
        'address'        => '',
        'menu'           =>
            [
                'test' =>
                    [
                        'sub-menu' => 'controller/action'
                    ]
            ],
        'message'        =>
            [
                'app-name',
                'app-name-2'
            ],
//		'modules'=>
//		[
//			'admin' => [
//				'class' => 'YiiMan\YiiBasics\modules\setting\modules\admin\Module',
//			],
//		],


    ];
