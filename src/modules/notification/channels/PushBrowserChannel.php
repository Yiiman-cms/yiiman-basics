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
use yii\db\ActiveRecord;

class PushBrowserChannel extends ChannelBase
{
    public $tokens =
        [
            'pushBrowserToken' =>
                [
                    'label' => 'توکن',
                    'hint'  => 'توکن ارسال نوتیفیکیشن را وارد کنید'
                ]
        ];

    public function title(): string
    {
        return 'پوش مسیج مرورگر';
    }

    public function sendNotification(
        string $message,
        string $name,
        array $params,
        ActiveRecord $receiver,
        int $type = 1
    ) {
        // TODO: Implement sendNotification() method.
    }
}