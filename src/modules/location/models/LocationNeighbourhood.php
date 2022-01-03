<?php

namespace YiiMan\YiiBasics\modules\location\models;

use Yii;

/**
 * This is the model class for table "{{%module_location_neighbourhood}}".
 *
 * @property int $id
 * @property string $name
 * @property int $city
 *
 * @property LocationCity $city0
 */
class LocationNeighbourhood extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_location_neighbourhood}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'city'], 'required'],
            [['city'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\location\models\LocationCity::className(), 'targetAttribute' => ['city' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('location', 'ID'),
            'name' => Yii::t('location', 'نام محله'),
            'city' => Yii::t('location', 'شهر'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity0()
    {
        return $this->hasOne(LocationCity::className(), ['id' => 'city']);
    }
}
