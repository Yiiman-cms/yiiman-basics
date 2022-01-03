<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: 12/29/2018
 * Time: 3:41 PM
 */

namespace YiiMan\YiiBasics\modules\filemanager\controllers;


use function ob_get_clean;
use function ob_implicit_flush;
use function ob_start;
use function realpath;
use YiiMan\YiiBasics\lib\Controller;
use Yii;
use yii\web\Response;

class AjaxController extends Controller
{
    public $enableCsrfValidation = false;
    protected $post;

    public function actionIndex()
    {


//			Yii::$app->response->format=Response::FORMAT_JSON;

        return include realpath(__DIR__.'/../components/index.php');


    }


}
