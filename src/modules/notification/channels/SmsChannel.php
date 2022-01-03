<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\notification\channels;


use YiiMan\YiiBasics\modules\notification\base\ChannelBase;
use YiiMan\YiiBasics\modules\sms\base\Sms;
use YiiMan\YiiBasics\modules\user\models\User;
use yii\db\ActiveRecord;

class SmsChannel extends ChannelBase
{
    public function title(): string
    {
        return 'اطلاعیه ی پیامکی';
    }

    public function sendNotification(
        string $message,
        string $name,
        array $params,
        ActiveRecord $receiver,
        int $type = 1
    ) {
        try {

            if (empty($receiver->mobile) && $receiver instanceof User) {
                $receiver->mobile = $receiver->username;
                $receiver->save();

            }

            if (empty($message)) {
                return;
            }
            $message = \Yii::$app->functions->limitText($message, 300);
            $message = str_replace([
                '(',
                ')',
                '_',
                '-',
                ':',
                '.'
            ], '', $message);

            if (!empty($receiver->mobile)) {
                Sms::sendSms($receiver->mobile, $message);
            }
        } catch (\Exception $e) {
            \Yii::error('Notification', 'sms send error: '.$e->getMessage());
        }
        // TODO: Implement sendNotification() method.
    }


}