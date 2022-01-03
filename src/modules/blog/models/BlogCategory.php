<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\blog\models;

use YiiMan\YiiBasics\lib\ActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%module_blog_comment}}".
 * @property int    $id
 * @property string $title
 * @property int    $parent
 */
class BlogCategory extends ActiveRecord
{
    private static $configs = [];

    public static function getConfigs()
    {
        return self::$configs;
    }

    public static function setConfigs($array)
    {
        self::$configs = $array;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_blog_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['title'],
                'required'
            ],
            [
                ['parent'],
                'integer'
            ],
        ];
    }

    public function attributeLabels()
    {
        return
            [
                'id'     => Yii::t('blog', 'شناسه'),
                'title'  => Yii::t('blog', 'عنوان'),
                'parent' => Yii::t('blog', 'دسته ی مادر'),
            ];
    }

    public function getParent0()
    {
        return $this->hasOne($this::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveRecord[]|null
     */
    public function getArticles0()
    {
        $fk = BlogArticleFkCategory::find()
            ->select(['article'])
            ->where(['category' => $this->id])
            ->asArray()
            ->all();
        if (!empty($fk)) {
            return BlogArticles::find()
                ->where(['id' => ArrayHelper::getColumn($fk, 'article')])
                ->all();
        } else {
            return null;
        }
    }


    public function getArticleCount()
    {
        return BlogArticleFkCategory::find()
            ->where(['category' => $this->id])
            ->count();
    }
}
