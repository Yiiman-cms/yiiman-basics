<?php


namespace YiiMan\YiiBasics\modules\sms\base;


class Sms
{
    /**
     * ارسال پیامک به صورت عادی
     *
     * @param string $receptor دریافت کنندده پیامک
     * @param string $message متن پیام
     * @return mixed
     */
    public static function sendSms(string $receptor, string $message)
    {
        $gate = \Yii::$app->Options->SmsGate;
        $gate="YiiMan\YiiBasics\modules\sms\gates\\$gate";
        return $gate::sendSms($receptor, $message);
    }

    /**
     * ارسال پیامک با الگو(اولویت دار)
     *
     * @param string $pattern نام الگو
     * @param string $receptor شماره دریافت کننده
     * @param string $token1
     * @param string $token2
     * @param string $token3
     * @param string $token4
     * @return mixed
     */
    public static function sendPattern(string $pattern,string $receptor, string $token1 = '', string $token2 = '', string $token3 = '', string $token4 = '')
    {
        $gate = \Yii::$app->Options->SmsGate;
        $gate="YiiMan\YiiBasics\modules\sms\gates\\$gate";

        return  $gate::sendPattern($receptor,$pattern, $token1 , $token2 , $token3 , $token4);
    }

    /**
     * @param array $receptors دریافت کنندگان پیامک
     * @param string $message متن پیامک
     * @return mixed
     */
    public static function sendGroup(array $receptors, string $message)
    {
        $gate = \Yii::$app->Options->SmsGate;
        $gate="YiiMan\YiiBasics\modules\sms\gates\\$gate";
        return $gate::sendGroup($receptors, $message);
    }


    public static function sendTestPattern(&$sendParams,&$Response,&$error){
        $gate = \Yii::$app->Options->SmsGate;
        $gate="YiiMan\YiiBasics\modules\sms\gates\\$gate";
        return $gate::sendTestMessagePattern($sendParams, $Response,$error);
    }

}