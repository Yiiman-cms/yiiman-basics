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

namespace YiiMan\YiiBasics\modules\filemanager;

/**
 * hotel module definition class
 */

use Yii;
use yii\helpers\ArrayHelper;

class Module extends \YiiMan\YiiBasics\lib\Module
{

    public $controllerNamespace = 'YiiMan\YiiBasics\modules\filemanager\controllers';

    public static function menus()
    {
        return
            [
                [
                    'title' => 'مدیریت فایل ها',
                    'icon'  => 'perm_media',
                    'url'   => 'filemanager'
                ]
            ];
    }

}
