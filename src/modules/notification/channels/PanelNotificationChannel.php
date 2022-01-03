<?php


namespace YiiMan\YiiBasics\modules\notification\channels;


use YiiMan\YiiBasics\modules\notification\base\ChannelBase;
use YiiMan\YiiBasics\modules\user\models\User;
use YiiMan\YiiBasics\modules\user\models\UserNotifications;
use yii\db\ActiveRecord;

class PanelNotificationChannel extends ChannelBase
{
    public $tokens =
        [

        ];

    public function title(): string
    {
        return 'نمایش اطلاعیه در پنل';
    }

    public function sendNotification(string $message, string $name, array $params, ActiveRecord $receiver, int $type = 1)
    {
        if ($receiver instanceof User){
            if (class_exists('YiiMan\YiiBasics\modules\user\models\UserNotifications')){
                UserNotifications::addUserNotifications(
                    $message,
                    $receiver->id,
                    UserNotifications::TYPE_WARNING
                );
            }else{
                \Yii::error('class UserNotifications not exist in user module for send notifications in user panel');
            }
        }
    }
}