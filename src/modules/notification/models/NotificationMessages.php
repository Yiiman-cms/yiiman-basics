<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\notification\models;

use Yii;

/**
 * This is the model class for table "{{%module_notification_messages}}".
 * @property int       $id
 * @property int       $uid           دریافت کننده
 * @property string    $message       متن پیام
 * @property string    $target_module کلاس ماژول مربوط به مسیج
 * @property int       $module_id     آي دی کلاس ماژول مربوطه
 * @property string    $notif_channel کانال مسیج(روش ارسال)
 * @property string    $created_at    تاریخ ثبت
 * @property int       $created_by    فرستنده
 * @property string    $details_json  اطلاعات مسیج برای کلاس کانال
 * @property int       $status        وضعیت ارسال
 * @property string    $sent_at       تاریخ ارسال
 * @property string    $send_error    خطای بوجود امده حین ارسال
 * @property int       $language
 * @property int       $language_parent
 * @property UserAdmin $u
 * @property User      $u0
 * @property UserAdmin $createdBy
 * @property User      $createdBy0
 */
class NotificationMessages extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_notification_messages}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'uid',
                    'message',
                    'target_module',
                    'notif_channel',
                    'created_at',
                    'created_by',
                    'details_json',
                    'status'
                ],
                'required'
            ],
            [
                [
                    'uid',
                    'module_id',
                    'created_by',
                    'status',
                    'language',
                    'language_parent'
                ],
                'integer'
            ],
            [
                [
                    'created_at',
                    'sent_at'
                ],
                'safe'
            ],
            [
                ['details_json'],
                'string'
            ],
            [
                ['message'],
                'string',
                'max' => 1000
            ],
            [
                [
                    'target_module',
                    'notif_channel'
                ],
                'string',
                'max' => 300
            ],
            [
                ['send_error'],
                'string',
                'max' => 700
            ],
            [
                ['uid'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => \YiiMan\YiiBasics\modules\user\models\UserAdmin::className(),
                'targetAttribute' => ['uid' => 'id']
            ],
            [
                ['uid'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => \YiiMan\YiiBasics\modules\user\models\User::className(),
                'targetAttribute' => ['uid' => 'id']
            ],
            [
                ['created_by'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => \YiiMan\YiiBasics\modules\user\models\UserAdmin::className(),
                'targetAttribute' => ['created_by' => 'id']
            ],
            [
                ['created_by'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => \YiiMan\YiiBasics\modules\user\models\User::className(),
                'targetAttribute' => ['created_by' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'              => Yii::t('notification', 'ID'),
            'uid'             => Yii::t('notification', 'دریافت کننده'),
            'message'         => Yii::t('notification', 'متن پیام'),
            'target_module'   => Yii::t('notification', 'کلاس ماژول مربوط به مسیج'),
            'module_id'       => Yii::t('notification', 'آي دی کلاس ماژول مربوطه'),
            'notif_channel'   => Yii::t('notification', 'کانال مسیج(روش ارسال)'),
            'created_at'      => Yii::t('notification', 'تاریخ ثبت'),
            'created_by'      => Yii::t('notification', 'فرستنده'),
            'details_json'    => Yii::t('notification', 'اطلاعات مسیج برای کلاس کانال'),
            'status'          => Yii::t('notification', 'وضعیت ارسال'),
            'sent_at'         => Yii::t('notification', 'تاریخ ارسال'),
            'send_error'      => Yii::t('notification', 'خطای بوجود امده حین ارسال'),
            'language'        => Yii::t('notification', 'Language'),
            'language_parent' => Yii::t('notification', 'Language Parent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(UserAdmin::className(), ['id' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU0()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(UserAdmin::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
