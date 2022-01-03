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

/**
 * This is the model class for table "{{%module_blog_comment}}".
 * @property int $id
 * @property int $article
 * @property int $category
 */
class BlogArticleFkCategory extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_blog_cat_article_fk}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'category',
                    'article'
                ],
                'required'
            ],
            [
                [
                    'category',
                    'article'
                ],
                'integer'
            ],
        ];
    }

    /**
     * @return array|BlogArticleFkCategory|\yii\db\ActiveRecord|null
     */
    public function getCategory0()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'category'])->one();
    }
}
