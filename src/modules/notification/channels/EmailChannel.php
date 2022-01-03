<?php


namespace YiiMan\YiiBasics\modules\notification\channels;


use YiiMan\YiiBasics\modules\notification\base\ChannelBase;
use yii\db\ActiveRecord;

class EmailChannel extends ChannelBase
{
    public function title(): string
    {
        return 'ایمیل(رایانامه)';
    }

    public function sendNotification(string $message, string $name, array $params, ActiveRecord $receiver, int $type = 1)
    {
        try {
            /**
             * if email has 500 exception:
             *
             * comment Line 160 in this file:
             *
             * vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php
             */
            if (!empty($receiver->email)) {
                $email=\Yii::$app
                    ->mail
                    ->compose(
                        ['html' => '@frontend/views/mail/template-html', 'text' => '@frontend/views/mail/template-html'],
                        ['content' => $message]
                    )
                    ->setFrom([\Yii::$app->Options->senderEmail => \Yii::$app->Options->senderName])
                    ->setTo($receiver->email)
                    ->setSubject('اطلاعیه از سایت ' . \Yii::$app->Options->siteTitle)
                    ->send();
            }

        }
        catch (\Exception $e) {
            $error=$e;
        }
        catch (\Swift_TransportException $e) {
            $error=$e;
        }

    }
}