<?php

namespace YiiMan\YiiBasics\modules\ticket\models;

use Yii;
use \YiiMan\YiiBasics\modules\ticketdepartmentusers\models\TicketDepartmentUsers;

/**
 * This is the model class for table "{{%module_ticket_departments}}".
 *
 * @property int $id
 * @property string $title نام دپارتمان
 * @property int $status وضعیت انتشار
 * @property int $language
 * @property int $language_parent
 *
 * @property TicketDepartmentUsers[] $ticketDepartmentUsers
 */
class TicketDepartments extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_ticket_departments}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['id', 'status', 'language', 'language_parent'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ticket', 'ID'),
            'title' => Yii::t('ticket', 'نام دپارتمان'),
            'status' => Yii::t('ticket', 'وضعیت انتشار'),
            'language' => Yii::t('ticket', 'Language'),
            'language_parent' => Yii::t('ticket', 'Language Parent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketDepartmentUsers()
    {
        return $this->hasMany(TicketDepartmentUsers::className(), ['department' => 'id']);
    }
}
