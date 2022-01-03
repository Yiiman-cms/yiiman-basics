<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

$dir = basename(__DIR__);

$conf =
    [
        'name'      => $dir,
        'name_fa'   => 'لاگ ها',
        'type'      => ['backend'],
        'namespace' => 'YiiMan\YiiBasics\modules\\'.$dir,
        'address'   => '',
    ];

if (!defined('MTHJK_'.$dir)) {
    define('MTHJK_'.$dir, '1');
}

return $conf;
