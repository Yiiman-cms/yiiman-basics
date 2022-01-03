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
use YiiMan\YiiBasics\modules\hint\models\Hint;
use YiiMan\YiiBasics\modules\metadata\models\Metadata;
use YiiMan\YiiBasics\modules\slug\models\Slug;
use YiiMan\YiiBasics\modules\user\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%module_blog_articles}}".
 * @property int                                                $id
 * @property string                                             $title
 * @property string                                             $content
 * @property string                                             $image
 * @property string                                             $created_at
 * @property int                                                $author
 * @property int                                                $enable_comment
 * @property int                                                $status
 * @property int                                                $likeCount
 * @property int                                                $commentCount
 * @property User                                               $author0
 * @property \YiiMan\YiiBasics\modules\blog\models\BlogArticles $prevArticle0
 * @property \YiiMan\YiiBasics\modules\blog\models\BlogArticles $nextArticle0
 */
class BlogArticles extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;
    public static $parentalComments = [];
    public $tags;
    public $seo_description;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return
            [
                [
                    [
                        'title',
                        'content',
                        'created_at',
                        'author',
                        'status'
                    ],
                    'required'
                ],
                [
                    ['content'],
                    'string'
                ],
                [
                    ['created_at'],
                    'safe'
                ],
                [
                    [
                        'author',
                        'status',
                        'language',
                        'enable_comment'
                    ],
                    'integer'
                ],
                [
                    [
                        'title',
                        'seo_description'
                    ],
                    'string',
                    'max' => 255
                ],
                [
                    ['tags'],
                    'safe'
                ],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'              => Yii::t('blog', 'شناسه'),
            'title'           => Yii::t('blog', 'موضوع'),
            'content'         => Yii::t('blog', 'محتوا'),
            'image'           => Yii::t('blog', 'تصویر شاخص'),
            'created_at'      => Yii::t('blog', 'زمان ایجاد'),
            'author'          => Yii::t('blog', 'نویسنده'),
            'status'          => Yii::t('blog', 'وضعیت انتشار'),
            'seo_description' => Yii::t('blog', 'تضیحات سئو'),
            'tags'            => Yii::t('blog', 'برچسب ها'),
        ];
    }

    public function saveSeoDetails()
    {
        if (!empty($this->tags) && !empty($this->seo_description)) {
            Yii::$app->MetaLib->set('ARTICLE_SEO_TAG', $this->tags, $this->id, true);
            Yii::$app->MetaLib->set('ARTICLE_SEO_DESCRIPTION', $this->seo_description, $this->id, true);
        }
    }

    public function loadSeoDetails()
    {
        $tags = Yii::$app->MetaLib->get('ARTICLE_SEO_TAG', $this->id);
        if (!empty($tags)) {
            $tagArray = [];
            if (is_array($tags)) {
                foreach ($tags as $tag) {
                    $tagArray[] = $tag->content;
                }
            } else {
                $tagArray[] = $tags->content;
            }
            $this->tags = $tagArray;
        }

        $seo_description = Yii::$app->MetaLib->get('ARTICLE_SEO_DESCRIPTION', $this->id);
        if (!empty($seo_description)) {
            $this->seo_description = $seo_description->content;
        }
    }

    public function getAuthor0()
    {
        return $this->hasOne(\YiiMan\YiiBasics\modules\useradmin\models\User::className(), ['id' => 'author']);
    }

    public function getCommentCount()
    {
        return BlogComment::find()->where(
            [
                'article' => $this->id,
                'status'  => BlogComment::STATUS_ACTIVE
            ]
        )->count();
    }

    public function generateUrl()
    {
        $slug = Slug::getSlug($this);
        if (!empty($slug)) {
            return Yii::$app->Options->URL.'/'.$slug;
        } else {
            return Yii::$app->Options->URL.'/article/'.$this->id;
        }
    }

    public function getLikeCount()
    {
        $meta = Yii::$app->MetaLib->get('ARTICLE_LIKE', $this->id);
        if (!empty($meta)) {
            return $meta->content;
        } else {
            return 0;
        }
    }

    public function getNextArticle0()
    {
        return $this->find()->where([
            '>',
            'id',
            $this->id
        ])->one();
    }

    public function getPrevArticle0()
    {
        return $this->find()->where([
            '<',
            'id',
            $this->id
        ])->orderBy('id desc')->one();
    }

    /**
     * پست های محبوب را بازگردانی میکند
     * @param  int  $limit
     * @return BlogArticles[]|null
     */
    public function papulates($limit = 3)
    {
        $hint = Hint::find()
            ->select([
                'table_id',
                'SUM(`count`) as count'
            ])
            ->where(['table' => $this::tableName()])
            ->groupBy('table_id')
            ->limit($limit)
            ->asArray()
            ->all();
        if (empty($hint)) {
            return null;
        }
        $ids = ArrayHelper::getColumn($hint, 'table_id');
        return $this::find()
            ->where([
                'id'     => $ids,
                'status' => self::STATUS_ACTIVE
            ])
            ->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_blog_articles}}';
    }

    private function getAllActiveForWidget($location)
    {
        $items = $this->getAllCommented();
        self::$parentalComments = ArrayHelper::index($items, 'parent');
        $idial = ArrayHelper::index($items, 'id');
        $all = [];

        foreach ($idial as $id => $item) {
            $all[] = $this->buildItemComment($idial, $id);
        }
        return $all;
    }

    /**
     * @return array|\YiiMan\YiiBasics\modules\menu\models\Menu[]|\yii\db\ActiveRecord[]
     */
    private function getAllCommented()
    {

        return BlogComment::find()
            ->where([
                'status'  => self::STATUS_ACTIVE,
                'article' => $this->id
            ])
            ->orderBy(['index' => SORT_ASC])
            ->asArray()
            ->all();
    }

    private function buildItemComment($items, $id)
    {

        $parental = ArrayHelper::index($items, 'parent');
        $array = [];

        $array['label'] = $items[$id]['title'];
        $array['url'] = $items[$id]['url'];
        $array['parent_id'] = $items[$id]['parent_id'];
        $subItems = [];
        if (!empty(self::$parentalComments[$id])) {

            $subItems[] = $this->buildItemComment($items, self::$parentalComments[$id]['id']);

        }
        $array['items'] = $subItems;
        return $array;
    }


}
