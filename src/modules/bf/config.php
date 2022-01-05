<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\lib\Triggers;
use yii\base\Event;
use yii\web\Application;

$dir = basename(__DIR__);


$conf =
    [
        'name'      => $dir,
        'type'      => ['backend'],
        'namespace' => 'YiiMan\YiiBasics\modules\\'.$dir,
        'address'   => '',
        'menu'      =>
            [
                'name'  => $dir,
                'title' => Yii::t('bf', 'bruit forces'),
                'icon'  => 'people'
            ]
        ,
    ];

if (!defined('MTHJK_'.$dir)) {
    define('MTHJK_'.$dir, '1');
}

return $conf;
