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

namespace YiiMan\YiiBasics\modules\transactions;

/**
 * transactions module definition class
 */

use Yii;
use yii\helpers\ArrayHelper;

class Module extends  \YiiMan\YiiBasics\lib\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace='YiiMan\YiiBasics\modules\transactions\controllers';
 
    public static function menus()
    {
        return 
        [
            
        ];
    }
    
    public static function settings()
    {
        return 
        [
            Yii::t('transactions', 'تنظیمات پرداخت')=>function($form){
                return Yii::$app->view->render('@vendor/yiiman/yi-basics/src/modules/transactions/settings/gateOptions.php',['form'=>$form]);
            }  
        ];
    }
}
