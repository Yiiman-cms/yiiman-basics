<?php


namespace YiiMan\YiiBasics\modules\sms\base;


interface BaseGateInterface
{

    /**
     * نام درگاه پیامک
     * @return mixed
     */
    public static function title();

    /**
     * ارسال پیامک به صورت عادی
     *
     * @param string $receptor دریافت کنندده پیامک
     * @param string $message متن پیام
     * @return mixed
     */
    public static function sendSms(string $receptor,string $message);

    /**
     * ارسال پیامک با الگو(اولویت دار)
     * @param string $receptor دریافت کننده ی پیامک
     * @param string $pattern نام الگو
     * @param string $token1
     * @param string $token2
     * @param string $token3
     * @param string $token4
     * @return mixed
     */
    public static function sendPattern(string $receptor,string $pattern,string $token1 = '',string  $token2 = '',string  $token3 = '',string $token4 = '');

    /**
     * @param array $receptors دریافت کنندگان پیامک
     * @param string $message متن پیامک
     * @return mixed
     */
    public static function sendGroup(array $receptors,string $message);

    /**
     * ارسال پیامک مبتنی بر الگو برای تست صحت تنظیمات انجام شده و تست ارسال صحیح از پنل پیامک
     * @param array $sendParams
     * @param string $Response
     * @param string $error
     * @return mixed
     */
    public static function sendTestMessagePattern(array &$sendParams,string &$Response,string &$error);

}