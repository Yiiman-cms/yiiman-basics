<?php

namespace YiiMan\YiiBasics\modules\ticket\models;

use Yii;

/**
 * This is the model class for table "{{%module_ticket_department_users}}".
 *
 * @property int $id
 * @property int $department دپارتمان
 * @property int $uid کاربر
 * @property int $language
 * @property int $language_parent
 *
 * @property UserAdmin $u
 * @property TicketDepartments $department0
 */
class TicketDepartmentUsers extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_ticket_department_users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department', 'uid'], 'required'],
            [['id', 'department', 'uid', 'language', 'language_parent'], 'integer'],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\user\models\UserAdmin::className(), 'targetAttribute' => ['uid' => 'id']],
            [['department'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\ticket\models\TicketDepartments::className(), 'targetAttribute' => ['department' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ticket', 'ID'),
            'department' => Yii::t('ticket', 'دپارتمان'),
            'uid' => Yii::t('ticket', 'کاربر'),
            'language' => Yii::t('ticket', 'Language'),
            'language_parent' => Yii::t('ticket', 'Language Parent'),
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
    public function getDepartment0()
    {
        return $this->hasOne(TicketDepartments::className(), ['id' => 'department']);
    }
}
