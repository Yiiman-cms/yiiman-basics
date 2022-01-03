<?php

namespace YiiMan\YiiBasics\modules\gallery\models;

use Yii;
use \YiiMan\YiiBasics\modules\gallery\models\GalleryFkMediasCategories;
use \YiiMan\YiiBasics\modules\gallery\models\GalleryMedias;
/**
* This is the model class for table "{{%module_gallery_categories}}".
*
    * @property int $id
    * @property string $title
    * @property string $description
    * @property string $image
    * @property int $parent
    * @property int $language
    * @property int $language_parent
    *
            * @property GalleryCategories $parent0
            * @property GalleryCategories[] $galleryCategories
            * @property GalleryCategories $languageParent
            * @property GalleryCategories[] $galleryCategories0
            * @property Language $language0
            * @property GalleryFkMediasCategories[] $galleryFkMediasCategories
            * @property GalleryMedias[] $galleryMedias
    */
class GalleryCategories extends \YiiMan\YiiBasics\lib\ActiveRecord
{
const STATUS_ACTIVE=1;
const STATUS_DE_ACTIVE=0;

/**
* {@inheritdoc}
*/
public static function tableName()
{
return '{{%module_gallery_categories}}';
}

/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['title', 'image', 'language'], 'required'],
            [['description'], 'string'],
            [['parent', 'language', 'language_parent'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' =>\YiiMan\YiiBasics\modules\gallery\models\GalleryCategories::className(), 'targetAttribute' => ['parent' => 'id']],
            [['language_parent'], 'exist', 'skipOnError' => true, 'targetClass' =>\YiiMan\YiiBasics\modules\gallery\models\GalleryCategories::className(), 'targetAttribute' => ['language_parent' => 'id']],
            [['language'], 'exist', 'skipOnError' => true, 'targetClass' =>\YiiMan\YiiBasics\modules\language\models\Language::className(), 'targetAttribute' => ['language' => 'id']],
        ];
}

/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('gallery', 'ID'),
    'title' => Yii::t('gallery', 'Title'),
    'description' => Yii::t('gallery', 'Description'),
    'image' => Yii::t('gallery', 'Image'),
    'parent' => Yii::t('gallery', 'Parent'),
    'language' => Yii::t('gallery', 'Language'),
    'language_parent' => Yii::t('gallery', 'Language Parent'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getParent0()
    {
    return $this->hasOne(GalleryCategories::className(), ['id' => 'parent']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getGalleryCategories()
    {
    return $this->hasMany(GalleryCategories::className(), ['parent' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getLanguageParent()
    {
    return $this->hasOne(GalleryCategories::className(), ['id' => 'language_parent']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getGalleryCategories0()
    {
    return $this->hasMany(GalleryCategories::className(), ['language_parent' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getLanguage0()
    {
    return $this->hasOne(Language::className(), ['id' => 'language']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getGalleryFkMediasCategories()
    {
    return $this->hasMany(GalleryFkMediasCategories::className(), ['category' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getGalleryMedias()
    {
    return $this->hasMany(GalleryMedias::className(), ['category' => 'id']);
    }
}
