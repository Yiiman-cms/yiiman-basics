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

namespace YiiMan\YiiBasics\modules\location;

/**
 * location module definition class
 */


use Yii;
use yii\helpers\ArrayHelper;

class Module extends  \YiiMan\YiiBasics\lib\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace='YiiMan\YiiBasics\modules\location\controller';

    public static function menus()
    {
        return
        [
            [
                'title' => 'موقعیت جغرافیایی',
                'items' =>
                    [
                        [
                            'name'  => 'locations',
                            'title' => 'شهر ها',
                        ],
                        [
                            'name'  => 'location/neighbourhood',
                            'title' => 'محلات',
                        ],
                    ]
            ]
        ];
    }

}
