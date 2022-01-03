<?php


namespace YiiMan\YiiBasics\modules\sms\base;


class BaseGate implements BaseGateInterface
{

    /**
     * توکن هایی که نیاز دارید کاربر برای ارتباط به پنل به شما بدهد را اینجا با نام فارسی وارد کنید.
     *
     * برای مثال:
     *
     * [
     *
     *
     *  'Username'=>
     *
     *          [
     *
     *          'label'=>'نام کاربری درگاه',
     *
     *          'hint'=>'لطفا نام کاربری درگاه را وارد کنید',
     *
     *          ],
     *  'apiToken'=>'توکن واسط کاربری'
     *
     * ]
     *
     * @var array
     */
    public $tokens = [];


    public static function title()
    {
        // TODO: Implement title() method.
    }

    public static function sendSms(string $receptor, string $message)
    {
        // TODO: Implement sendSms() method.
    }

    public static function sendPattern(string $receptor,string $pattern, string $token1 = '', string $token2 = '', string $token3 = '', string $token4 = '')
    {
        // TODO: Implement sendPattern() method.
    }

    public static function sendGroup(array $receptors, string $message)
    {
        // TODO: Implement sendGroup() method.
    }

    public function renderForm()
    {
        return \Yii::$app->view->render('@system/modules/sms/settings/autorender.php',
            [
                'tokens'=>$this->tokens
            ]
        );
    }


    public static function sendTestMessagePattern(array &$sendParams,string &$Response,string &$error){}
}