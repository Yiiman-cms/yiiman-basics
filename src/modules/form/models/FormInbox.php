<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\form\models;

use Yii;

/**
 * This is the model class for table "{{%module_form_inbox}}".
 * @property int    $id
 * @property string $ip
 * @property string $created_at
 * @property int    $status
 * @property string $details
 * @property string $title
 * @property int    $form
 * @property Form   $form0
 */
class FormInbox extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_SEEN = 1;
    const STATUS_NOT_SEEN = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_form_inbox}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'created_at',
                    'status',
                    'details',
                    'form'
                ],
                'required'
            ],
            [
                ['created_at'],
                'safe'
            ],
            [
                [
                    'status',
                    'form'
                ],
                'integer'
            ],
            [
                ['ip'],
                'string',
                'max' => 15
            ],
            [
                ['title'],
                'string',
                'max' => 255
            ],
            [
                ['form'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => \YiiMan\YiiBasics\modules\form\models\Form::className(),
                'targetAttribute' => ['form' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('form', 'ID'),
            'ip'         => Yii::t('form', 'Ip'),
            'created_at' => Yii::t('form', 'تاریخ ثبت'),
            'status'     => Yii::t('form', 'وضعیت بازبینی'),
            'details'    => Yii::t('form', 'اطللاعات'),
            'title'      => Yii::t('form', 'عنوان'),
            'form'       => Yii::t('form', 'فرم'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForm0()
    {
        return $this->hasOne(Form::className(), ['id' => 'form']);
    }
}
