<?php

namespace YiiMan\YiiBasics\modules\ticket\models;

use Yii;
use YiiMan\YiiBasics\modules\user\models\User;
use YiiMan\YiiBasics\modules\ticket\models\TicketMessages;

/**
 * This is the model class for table "{{%module_ticket}}".
 *
 * @property int $id
 * @property string $subject موضوع
 * @property string $created_at تاریخ ثبت
 * @property string $created_by ثبت شده توسط
 * @property string $updated_at آخرین بروزرسانی
 * @property string $updated_by بروزرسانی شده توسط
 * @property int $status وضعیت
 * @property int $department دپارتمان
 * @property string $deleted_at زمان حذف
 * @property string $deleted_by حذف شده توسط
 * @property string $closed_at تاریخ بسته شدن
 * @property string $serial سریال تیکت
 * @property int $language
 * @property int $language_parent
 * @property int $uid شناسه ی کاربری ثبت کننده
 * @property User $uid0 کاربر ثبت کننده
 * @property TicketMessages[] $ticketMessages
 */
class Ticket extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_WAITING = 1;
    const STATUS_ANSWERED = 2;
    const STATUS_CLOSED = 0;

    const statuses =
        [
            self::STATUS_WAITING => 'در انتظار پاسخ',
            self::STATUS_ANSWERED => 'پاسخ داده شده',
            self::STATUS_CLOSED => 'بسته شده'
        ];
    const statuses_html =
        [
            self::STATUS_WAITING => '<span class="badge badge-warning">در انتظار پاسخ</span>',
            self::STATUS_ANSWERED => '<span class="badge badge-success">پاسخ داده شده</span>',
            self::STATUS_CLOSED => '<span class="badge badge-black">بسته شده</span>'
        ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_ticket}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return
            [
                [['subject', 'created_at', 'created_by', 'updated_at', 'updated_by', 'status', 'department'], 'required'],
                [['id', 'status', 'department', 'language', 'language_parent'], 'integer'],
                [['created_at', 'updated_at', 'deleted_at', 'closed_at'], 'safe'],
                [['created_by', 'serial'], 'string'],
                [['subject', 'updated_by', 'deleted_by'], 'string', 'max' => 255],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return
            [
                'id' => Yii::t('ticket', 'ID'),
                'subject' => Yii::t('ticket', 'موضوع'),
                'serial' => Yii::t('ticket', 'سریال تیکت'),
                'created_at' => Yii::t('ticket', 'تاریخ ثبت'),
                'created_by' => Yii::t('ticket', 'ثبت شده توسط'),
                'updated_at' => Yii::t('ticket', 'آخرین بروزرسانی'),
                'updated_by' => Yii::t('ticket', 'بروزرسانی شده توسط'),
                'status' => Yii::t('ticket', 'وضعیت'),
                'department' => Yii::t('ticket', 'دپارتمان'),
                'deleted_at' => Yii::t('ticket', 'زمان حذف'),
                'deleted_by' => Yii::t('ticket', 'حذف شده توسط'),
                'closed_at' => Yii::t('ticket', 'تاریخ بسته شدن'),
                'language' => Yii::t('ticket', 'Language'),
                'language_parent' => Yii::t('ticket', 'Language Parent'),
            ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketMessages()
    {
        return $this->hasMany(TicketMessages::className(), ['ticket' => 'id']);
    }

    /**
     * تعداد کد تیکت های ثبت شده
     * @param null $uid
     * @return bool|int|string|null
     */
    public static function userTicketCount($uid = null)
    {
        if (empty($uid)) {
            $uid = Yii::$app->user->id;
        }
        return self::find()->where($uid)->count();
    }

    /**
     * ایجاد سریال جدید برای کاربر
     * @return string
     */
    public static function createSerial()
    {
        $uid = Yii::$app->user->id;
        $count = self::find()->where(['uid' => $uid])->count();
        $day = date('d');
        $year = date('y');
        $month = date('m');
        return (string)$month . $day . $uid . $count;
    }
}
