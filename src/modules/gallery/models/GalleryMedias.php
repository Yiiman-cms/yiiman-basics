<?php

namespace YiiMan\YiiBasics\modules\gallery\models;

use YiiMan\YiiBasics\modules\language\models\Language;
use Yii;
use \YiiMan\YiiBasics\modules\gallery\models\GalleryFkMediasCategories;

/**
 * This is the model class for table "{{%module_gallery_medias}}".
 *
 * @property int $id
 * @property string $type
 * @property string $table
 * @property string $description
 * @property string $className
 * @property string $fieldName
 * @property int $table_id
 * @property string $file_name
 * @property string $extension
 * @property string $contentType
 * @property string $path
 * @property double $file_size
 * @property int $category
 * @property int $language
 * @property int $default
 * @property int $language_parent
 *
 * @property GalleryFkMediasCategories[] $galleryFkMediasCategories
 * @property GalleryCategories $category0
 * @property Language $language0
 * @property GalleryMedias $languageParent
 * @property GalleryMedias[] $galleryMedias
 */
class GalleryMedias extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_gallery_medias}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return
            [
                [['type', 'table', 'table_id', 'file_name', 'file_size', 'language'], 'required'],
                [['table_id', 'category', 'language', 'language_parent', 'default'], 'integer'],
                [['file_size'], 'number'],
                [['type', 'extension'], 'string', 'max' => 20],
                [['table', 'description', 'file_name', 'contentType', 'path', 'className'], 'string', 'max' => 255],
                [['category'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\gallery\models\GalleryCategories::className(), 'targetAttribute' => ['category' => 'id']],
                [['language'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\language\models\Language::className(), 'targetAttribute' => ['language' => 'id']],
                [['language_parent'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\gallery\models\GalleryMedias::className(), 'targetAttribute' => ['language_parent' => 'id']],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('gallery', 'ID'),
            'type' => Yii::t('gallery', 'Type'),
            'table' => Yii::t('gallery', 'Table'),
            'description' => Yii::t('gallery', 'Description'),
            'table_id' => Yii::t('gallery', 'Table ID'),
            'file_name' => Yii::t('gallery', 'File Name'),
            'file_size' => Yii::t('gallery', 'File Size'),
            'category' => Yii::t('gallery', 'Category'),
            'language' => Yii::t('gallery', 'Language'),
            'language_parent' => Yii::t('gallery', 'Language Parent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleryFkMediasCategories()
    {
        return $this->hasMany(GalleryFkMediasCategories::className(), ['media' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(GalleryCategories::className(), ['id' => 'category']);
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
    public function getLanguageParent()
    {
        return $this->hasOne(GalleryMedias::className(), ['id' => 'language_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleryMedias()
    {
        return $this->hasMany(GalleryMedias::className(), ['language_parent' => 'id']);
    }


    public function delete()
    {
        $FilePath = Yii::$app->Options->UploadDir . '/dl/' . $this->className . '/' . $this->file_name . $this->extension;
        $FolderPath = Yii::$app->Options->UploadDir . '/dl/' . $this->className;
        $subFolders = getFileList($FolderPath);
        @unlink($FilePath);
        if (!empty($subFolders)) {
            foreach ($subFolders as $sub) {
                @unlink(Yii::$app->Options->UploadDir . '/dl/' . $this->className . '/' . $sub['name'] . '/' . $this->file_name . $this->extension);
                if ($sub['type'] == 'dir') {
                    $sub2 = getFileList(Yii::$app->Options->UploadDir . '/dl/' . $this->className . '/' . $sub['name']);
                    if (!empty($sub2)) {
                        foreach ($sub2 as $folder) {
                            if ($folder['type'] == 'dir') {
                                @unlink(Yii::$app->Options->UploadDir . '/dl/' . $this->className . '/' . $sub['name'] . '/' . $folder['name'] . '/' . $this->file_name . $this->extension);
                            }
                        }
                    }
                }
            }

        }
        @unlink($FilePath);
        parent::delete();
    }
}
