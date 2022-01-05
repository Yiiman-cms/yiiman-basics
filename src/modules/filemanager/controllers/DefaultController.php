<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\filemanager\controllers;

use YiiMan\YiiBasics\lib\Controller;

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: 12/29/2018
 * Time: 2:49 PM
 */
class DefaultController extends Controller
{
    public function actionIframe()
    {
        $this->layout = '@vendor/yiiman/yii-basics/src/modules/filemanager/views/layouts/main.php';
        return $this->render('iframe');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionWidgetIframe()
    {
        $this->layout = '@vendor/yiiman/yii-basics/src/modules/filemanager/views/layouts/main.php';
        return $this->render('widget-iframe');
    }

}
