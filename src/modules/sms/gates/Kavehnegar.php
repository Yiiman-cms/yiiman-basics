<?php


namespace YiiMan\YiiBasics\modules\sms\gates;


use YiiMan\YiiBasics\lib\HttpException;
use YiiMan\YiiBasics\modules\sms\base\BaseGate;
use YiiMan\YiiBasics\modules\sms\base\smsOptions;

class Kavehnegar extends BaseGate
{
    const APIPATH = "http://api.kavenegar.com/v1/%s/%s/%s.json/";
    const VERSION = "1.1.0";

    public $tokens =
        [
            'kavehnegarTOKEN' => 'توکن اتصال به درگاه',

            'smsTestReceiver'=>
            [
              'label'=>'شماره ی دریافت کننده پیامک تست',
              'hint'=>'شماره همراهی که اینجا وارد میکنید زمانی مورد استفاده قرار میگیرد که از بخش ارسال پیامک تست در پایین این صفحه استفاده کنید. در این صورت پیامک های تست ارسالی از سیستم به این شماره مخابره میشود.'
            ],
            'KavehnegarLine' =>
                [
                    'label' => 'خط ارسال پنل',
                    'hint' => 'شماره خطی که پیامک از آن ارسال میشود را وارد کنید'
                ],

            'accountcharge' =>
                [
                    'label' => 'نام الگوی شارژ اکانت',
                    'hint' => 'نام الگویی که برای شارژ کردن اکانت کاربری وارد کرده اید را ثبت کنید.'
                ],
            'serviceuservalidate' =>
                [
                    'label' => 'نام الگوی اعتبارسنجی ثبت خدمت',
                    'hint' => 'نام الگویی که برای ارسال کد راستی آزمایی قبل از ثبت خدمت برای کاربر استفاده میشود را وارد کنید.'
                ],
            'verifycode' =>
                [
                    'label' => 'نام الگوی ارسال کد اعتبارسنجی',
                    'hint' => 'نام الگویی که برای ارسال کد راستی آزمایی به کاربر استفاده میشود را وارد کنید.'
                ],
            'accountpassword' =>
                [
                    'label' => 'نام الگوی ارسال رمز عبور جدید',
                    'hint' => 'نام الگویی که برای ارسال رمز عبور جدید به کاربر استفاده میشود را وارد کنید.'
                ],

        ];

    public static function title()
    {
        return 'درگاه پیامک کاوه نگار';
    }

    public static function sendPattern(string $receptor, string $pattern, string $token1 = '', string $token2 = '', string $token3 = '', string $token4 = '')
    {

        if (\Yii::$app->Options->SMSDebug) {
            return true;
        }

        $options = (new smsOptions());

        $pattern2=\Yii::$app->Options->{$pattern};
        if (empty($pattern2)){
            $pattern2=$pattern;
        }
        $path   = self::get_path("lookup", "verify");
        $params = array(
            "receptor" => $receptor,
            "token" => trim($token1),
            "token2" => trim($token2),
            "token3" => trim($token3),
            "template" => $pattern2,
            "type" => null
        );
        if(func_num_args()>5){
            $arg_list = func_get_args();
            if(isset($arg_list[6]))
                $params["token10"]=$arg_list[6];
            if(isset($arg_list[7]))
                $params["token20"]=$arg_list[7];
        }

        return self::execute($path, $params);
    }

    public static function sendSms(string $receptor, string $message)
    {

        if (\Yii::$app->Options->SMSDebug) {
            return true;
        }


        if (is_array($receptor)) {
            $receptor = implode(",", $receptor);
        }
        if (is_array($localid=null)) {
            $localid = implode(",", $localid);
        }
        $path   = self::get_path("send");
        $params = array(
            "receptor" => $receptor,
            "sender" => \Yii::$app->Options->KavehnegarLine,
            "message" => $message,
            "date" => null,
            "type" => null,
            "localid" => $localid
        );
        return self::execute($path, $params);

    }

    public static function sendTestMessagePattern(array &$sendParams,string &$Response,string &$error){
        $options = \Yii::$app->Options;

        $pattern=$options->accountcharge;

        $path   = self::get_path("lookup", "verify");
        $sendParams = array(
            "receptor" => trim($options->smsTestReceiver),
            "token" => trim('غلامرضا'),
            "token2" => trim('1000'),
            "token3" => trim($token3=''),
            "template" => $pattern,
            "type" => null
        );
        if(func_num_args()>5){
            $arg_list = func_get_args();
            if(isset($arg_list[6]))
                $params["token10"]=$arg_list[6];
            if(isset($arg_list[7]))
                $params["token20"]=$arg_list[7];
        }



        $headers       = array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            'charset: utf-8'
        );
        $fields_string = "";
        if (!is_null($sendParams)) {
            $fields_string = http_build_query($sendParams);
        }
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $path);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $fields_string);

        $Response     = curl_exec($handle);
        $code         = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        $content_type = curl_getinfo($handle, CURLINFO_CONTENT_TYPE);
        $curl_errno   = curl_errno($handle);
        $error   = curl_error($handle);
    }

    protected static function get_path($method, $base = 'sms')
    {

        return sprintf(self::APIPATH, \Yii::$app->Options->kavehnegarTOKEN, $base, $method);
    }

    protected static function execute($url, $data = null)
    {
        $headers       = array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            'charset: utf-8'
        );
        $fields_string = "";
        if (!is_null($data)) {
            $fields_string = http_build_query($data);
        }

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $fields_string);

        $response     = curl_exec($handle);
        $code         = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        $content_type = curl_getinfo($handle, CURLINFO_CONTENT_TYPE);
        $curl_errno   = curl_errno($handle);
        $curl_error   = curl_error($handle);
        if ($curl_errno) {
            throw new HttpException($curl_error, $curl_errno);
        }
        $json_response = json_decode($response);
        if ($code != 200 && is_null($json_response)) {
            throw new HttpException("Request have errors", $code);
        } else {
            $json_return = $json_response->return;
            if ($json_return->status != 200) {
                \Yii::error('Notification','sms sent error: '.$json_return->message);
            }

            return $json_response;
        }
    }
}