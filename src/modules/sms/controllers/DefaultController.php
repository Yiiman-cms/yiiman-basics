<?php

namespace YiiMan\YiiBasics\modules\sms\controllers;

use YiiMan\YiiBasics\modules\sms\base\BaseGate;
use YiiMan\YiiBasics\modules\sms\base\Sms;
use YiiMan\YiiBasics\modules\transactions\base\PaymentTerminal;
use Yii;
use YiiMan\YiiBasics\modules\hint\models\Hint;
use YiiMan\YiiBasics\modules\hint\models\SearchHint;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * DefaultController implements the CRUD actions for sms model.
 */
class DefaultController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     *
     * @var $model SearchHint
     */

    /**
     * Lists all Hint models.
     * @return mixed
     */
    public function actionSendtest()
    {
        echo '<pre>';
        echo Sms::sendSms(Yii::$app->Options->smsTestLine, 'این یک پیام تست است');
        echo '<span style="color:green">' . 'دریافت کننده' . '</span>';
        var_dump(Yii::$app->Options->smsTestLine);
        die();
    }

    public function actionSendtestpatten()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $sendParams=[];
        $Response='';
        $error='';
        Sms::sendTestPattern($sendParams, $Response, $error);
        return
        [
            'params'=>json_encode($sendParams,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE),
            'response'=>$Response,
            'error'=>$error
        ];
    }


    public function actionLoadform()
    {
        $post = Yii::$app->request->post();

        if (!empty($post['id'])) {
            $gateClass = \stdClass::class;
            eval('$gateClass = new YiiMan\YiiBasics\modules\sms\gates\\' . $post['id'] . ';');
            /**
             * @var $gateClass BaseGate
             */
            return $gateClass->renderForm();
        }
    }


}
