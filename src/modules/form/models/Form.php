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
use \YiiMan\YiiBasics\modules\forminbox\models\FormInbox;

/**
 * This is the model class for table "{{%module_form}}".
 * @property int         $id
 * @property string      $title
 * @property string      $details
 * @property FormInbox[] $formInboxes
 */
class Form extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;
    public $hasLanguage = false;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_form}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'title',
                    'details'
                ],
                'required'
            ],
            [
                ['details'],
                'string'
            ],
            [
                ['title'],
                'string',
                'max' => 255
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'      => Yii::t('form', 'ID'),
            'title'   => Yii::t('form', 'نام فرم'),
            'details' => Yii::t('form', 'اطلاعات'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormInboxes()
    {
        return $this->hasMany(\YiiMan\YiiBasics\modules\form\models\FormInbox::className(), ['form' => 'id']);
    }
}
