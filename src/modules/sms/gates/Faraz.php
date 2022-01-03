<?php


namespace YiiMan\YiiBasics\modules\sms\gates;


use YiiMan\YiiBasics\modules\sms\base\BaseGate;
use YiiMan\YiiBasics\modules\sms\base\smsOptions;

class Faraz extends BaseGate
{

    public $tokens =
        [
            'username' => 'نام کاربری پنل',
            'password' => 'رمز عبور پنل',
            'smsTestReceiver'=>
            [
              'label'=>'شماره ی دریافت کننده پیامک تست',
              'hint'=>'شماره همراهی که اینجا وارد میکنید زمانی مورد استفاده قرار میگیرد که از بخش ارسال پیامک تست در پایین این صفحه استفاده کنید. در این صورت پیامک های تست ارسالی از سیستم به این شماره مخابره میشود.'
            ],
            'line' =>
                [
                    'label' => 'خط ارسال پنل',
                    'hint' => 'شماره خطی که پیامک از آن ارسال میشود را وارد کنید'
                ],
            'token' =>
                [
                    'label' => 'توکن اتصال به درگاه',
                    'hint' => 'توکن اتصال به درگاه پرداخت پنل پیامک'
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
        return 'درگاه پیامک فراز';
    }

    public static function sendPattern(string $receptor, string $pattern, string $token1 = '', string $token2 = '', string $token3 = '', string $token4 = '')
    {
//        echo '<pre>';
        $options = (new smsOptions());
//        var_dump($pattern);
        $pattern=$options->{$pattern};

//        var_dump($pattern);
//        die();
//        if (\Yii::$app->Options->SMSDebug) {
//            return true;
//        }
        $url = "https://sms.medicart.ir?";

        $post =
            [
                'apikey'=> trim($options->token),
                'pid'=> $pattern,
                'fnum'=> $options->line,
                'tnum'=> $receptor,
                'p1'=> "v1",
                'p2'=> "v2",
                'v1'=> $token1,
                'v2'=> $token2,
            ]
        ;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url.http_build_query($post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $res_data = curl_exec($ch);
        $error=curl_error($ch);
        if (!empty($error)){
            \Yii::error($error,'smsPanel');
        }
        curl_close($ch); // Close the connection
//        echo $res_data;
        $out=$res_data;
        return $out;
    }

    public static function sendSms(string $receptor, string $message)
    {
        $options = (new smsOptions());
        if (\Yii::$app->Options->SMSDebug) {
            return true;
        }

        $url = "https://ippanel.com/services.jspd";
        $param = array
        (
            'uname' => $options->username,
            'pass' => $options->password,
            'from' => trim($options->line),
            'message' => $message,
            'to' => json_encode($receptor),
            'op' => 'send'
        );

        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($handler);
        $error=curl_error($handler);
        if (!empty($error)){
            \Yii::error($error,'smsPanel');
            $res_data='';
        }else{
            $response2 = json_decode($response2);
            $res_code = $response2[0];
            $res_data = $response2[1];
        }


//        echo $res_data;
        return $res_data;
    }

    public static function sendTestMessagePattern(array &$sendParams,string &$Response,string &$error){
        $options = (new smsOptions());
//        var_dump($pattern);
        $pattern=$options->accountcharge;

//        var_dump($pattern);
//        die();
//        if (\Yii::$app->Options->SMSDebug) {
//            return true;
//        }
        $url = "https://sms.medicart.ir?";

        $sendParams =
            [
                'apikey'=> trim($options->token),
                'pid'=> $pattern,
                'fnum'=> $options->line,
                'tnum'=> trim($options->smsTestReceiver),
                'p1'=> "v1",
                'p2'=> "v2",
                'v1'=> 'غلامرضا',
                'v2'=> '1000',
            ]
        ;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url.http_build_query($sendParams));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $res_data = curl_exec($ch);
        $error=curl_error($ch);
        if (!empty($error)){
            \Yii::error($error,'smsPanel');
        }
        curl_close($ch); // Close the connection
//        echo $res_data;
        $Response=$res_data;
    }
}