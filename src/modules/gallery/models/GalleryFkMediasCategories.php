<?php

namespace YiiMan\YiiBasics\modules\gallery\models;

use Yii;
/**
* This is the model class for table "{{%module_gallery_fk_medias_categories}}".
*
    * @property int $id
    * @property int $media
    * @property int $category
    *
            * @property GalleryMedias $media0
            * @property GalleryCategories $category0
    */
class GalleryFkMediasCategories extends \YiiMan\YiiBasics\lib\ActiveRecord
{
const STATUS_ACTIVE=1;
const STATUS_DE_ACTIVE=0;

/**
* {@inheritdoc}
*/
public static function tableName()
{
return '{{%module_gallery_fk_medias_categories}}';
}

/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['media', 'category'], 'required'],
            [['media', 'category'], 'integer'],
            [['media'], 'exist', 'skipOnError' => true, 'targetClass' =>\YiiMan\YiiBasics\modules\gallery\models\GalleryMedias::className(), 'targetAttribute' => ['media' => 'id']],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' =>\YiiMan\YiiBasics\modules\gallery\models\GalleryCategories::className(), 'targetAttribute' => ['category' => 'id']],
        ];
}

/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('gallery', 'ID'),
    'media' => Yii::t('gallery', 'Media'),
    'category' => Yii::t('gallery', 'Category'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getMedia0()
    {
    return $this->hasOne(GalleryMedias::className(), ['id' => 'media']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getCategory0()
    {
    return $this->hasOne(GalleryCategories::className(), ['id' => 'category']);
    }
}
