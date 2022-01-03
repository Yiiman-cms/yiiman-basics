<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\notification\base;


use phpDocumentor\Reflection\Types\Void_;
use YiiMan\YiiBasics\modules\user\models\User;
use YiiMan\YiiBasics\modules\user\models\UserAdmin;
use yii\db\ActiveRecord;

interface ChannelBaseInterface
{
    const TYPE_SUCCESS = 1;
    const TYPE_WARNING = 2;
    const TYPE_DANGER = 3;
    const TYPE_INFO = 4;

    const INPUT_TXT = 'text';
    const INPUT_RADIO = 'radio';

    const STATUS_SENT = 1;
    const STATUS_WAIT = 2;
    const STATUS_IN_DEBUG_MODE = 3;
    const STATUS_SEND_ERROR = 4;
    const STATUS_SEND_DISABLED_BY_ADMIN = 5;
    const STATUS_SEND_DISABLED_BY_USER = 6;

    /**
     * نام کانال را بازگردانی میکند
     * @return string
     */
    public function title(): string;

    /**
     * این متد ورودی های مورد نیاز برای فرم شما را رندر میکند.
     * @return string
     */
    public function renderForm($form): string;

    /**
     * کدهای جاوا اسکریپت مربوط به فیلدهای کانال خود را اینجا درج کنید
     * @return string
     */
    public function renderJs(): string;

    /**
     * @param  string        $name      نام کنش مورد نظر
     * @param  array         $params    لیست پارامتر های تعریف شده برای کنش و مقادیر آنها
     * @param  ActiveRecord  $receiver  مدل کاربر دریافت کننده
     * @param  int           $type      نوع ارسال داده
     * @param  string        $message   متن پیغام
     * @return mixed
     */
    public function sendNotification(
        string $message,
        string $name,
        array $params,
        ActiveRecord $receiver,
        int $type = 1
    );
}