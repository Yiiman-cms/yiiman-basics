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

namespace YiiMan\YiiBasics\modules\gallery;

/**
 * gallery module definition class
 */


use Yii;
use yii\helpers\ArrayHelper;

class Module extends  \YiiMan\YiiBasics\lib\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace='YiiMan\YiiBasics\modules\gallery\controllers';
    
    
    public static function menus()
    {
        return 
        [
            [
                'title' => 'گالری',
                'items' =>
                    [
                        [
                            'url'  => '',
                            'title' => 'پوشه ها',
                        ],
                        [
                            'url'  => 'gallery-fk-medias-categories',
                            'title' => 'اتصالات فایل ها',
                        ],
                        [
                            'url'  => 'gallery-medias',
                            'title' => 'فایل ها',
                        ],
                    ]
            ]  
        ];
    }

}
