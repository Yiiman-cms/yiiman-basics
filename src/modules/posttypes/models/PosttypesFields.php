<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\posttypes\models;

use Yii;

/**
 * This is the model class for table "{{%module_posttypes_fields}}".
 * @property int       $id
 * @property string    $fieldName
 * @property string    $content
 * @property int       $posttype
 * @property Posttypes $posttype0
 */
class PosttypesFields extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_posttypes_fields}}';
    }

    public static function getFieldsWithIDs($ids)
    {
        return self::find()->where(['id' => $ids])->all();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'fieldName',
                    'posttype'
                ],
                'required'
            ],
            [
                ['content'],
                'string'
            ],
            [
                ['posttype'],
                'integer'
            ],
            [
                ['fieldName'],
                'string',
                'max' => 255
            ],
            [
                ['posttype'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => \YiiMan\YiiBasics\modules\posttypes\models\Posttypes::className(),
                'targetAttribute' => ['posttype' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'        => Yii::t('posttypes', 'ID'),
            'fieldName' => Yii::t('posttypes', 'Field Name'),
            'content'   => Yii::t('posttypes', 'Content'),
            'posttype'  => Yii::t('posttypes', 'Posttype'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosttype0()
    {
        return $this->hasOne(Posttypes::className(), ['id' => 'posttype']);
    }
}
