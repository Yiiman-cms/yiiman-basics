<?php
/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:09353466620
 * Company Phone:05138846411
 * Site:https://yiiman.ir
 * Date: 03/21/2020
 * Time: 12:19 PM
 */

namespace YiiMan\YiiBasics\modules\rbac\controllers;


use YiiMan\YiiBasics\lib\Controller;
use YiiMan\YiiBasics\modules\rbac\models\Provider;
use Yii;


class CreatePermissionsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        Provider::AllSystemPermissions();
        Yii::$app->session->addFlash('success', 'انجام شد');
        return $this->redirect(['/rbac/permission']);
    }
}
