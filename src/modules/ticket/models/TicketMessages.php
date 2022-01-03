<?php

namespace YiiMan\YiiBasics\modules\ticket\models;

use YiiMan\YiiBasics\modules\useradmin\models\User;
use Yii;

/**
 * This is the model class for table "{{%module_ticket_messages}}".
 *
 * @property int $id
 * @property int $ticket تیکت
 * @property string $message متن پاسخ
 * @property string $created_at تاریخ ثبت
 * @property string $created_by ثبت شده توسط
 * @property string $file فایل پیوست
 * @property int $language
 * @property int $language_parent
 * @property int $uid
 * @property \YiiMan\YiiBasics\modules\user\models\User $uid0
 * @property int $uid_admin
 * @property User $uid_admin0
 *
 *
 * @property Ticket $ticket0
 */
class TicketMessages extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_ticket_messages}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ticket', 'message', 'created_at', 'created_by'], 'required'],
            [['id', 'ticket', 'language', 'language_parent'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['created_by'], 'string', 'max' => 255],
            [['file'], 'string', 'max' => 400],
            [['ticket'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\ticket\models\Ticket::className(), 'targetAttribute' => ['ticket' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ticket', 'ID'),
            'ticket' => Yii::t('ticket', 'تیکت'),
            'message' => Yii::t('ticket', 'متن پاسخ'),
            'created_at' => Yii::t('ticket', 'تاریخ ثبت'),
            'created_by' => Yii::t('ticket', 'ثبت شده توسط'),
            'file' => Yii::t('ticket', 'فایل پیوست'),
            'language' => Yii::t('ticket', 'Language'),
            'language_parent' => Yii::t('ticket', 'Language Parent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket0()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket']);
    }

    /**
     * @return \YiiMan\YiiBasics\modules\user\models\User|null
     */
    public function getUid0(){
        return \YiiMan\YiiBasics\modules\user\models\User::findOne($this->uid);
    }

    /**
     * @return User|null
     */
    public function getUid_admin0(){
        return User::findOne($this->uid_admin);
    }
}
