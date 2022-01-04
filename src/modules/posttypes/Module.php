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

namespace YiiMan\YiiBasics\modules\posttypes;

/**
 * posttypes module definition class
 */


use Yii;
use yii\helpers\ArrayHelper;

class Module extends  \YiiMan\YiiBasics\lib\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace='YiiMan\YiiBasics\modules\posttypes\controllers';

    public static function menus()
    {
        return
        [
            [
                'title' => 'محصولات',
                'items' =>
                    [
                        [
                            'url'  => 'product',
                            'title' => 'محصول',
                        ],
                        [
                            'url'  => 'product/product-category',
                            'title' => 'گروه محصول',
                        ],
                    ]
            ]
        ];
    }
}
