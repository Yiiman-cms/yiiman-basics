<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\blog\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%module_blog_comment}}".
 * @property int          $id
 * @property string       $message
 * @property string       $name
 * @property string       $email
 * @property string       $website
 * @property int          $article
 * @property string       $created_at
 * @property BlogArticles $article0
 * @property int          $status
 */
class BlogComment extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;
    const STATUS_WAITING = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_blog_comment}}';
    }

    public static function addNewComment
    (
        string $message,
        int $article_id,
        string $email = '',
        int $replyToId = 0,
        string $name = '',
        string $site = ''
    ) {
        $model = new self();
        $model->message = nl2br(Yii::$app->functions->limitText($message, 1000));
        $model->name = Yii::$app->functions->limitText($name, 50);
        $model->email = Yii::$app->functions->limitText($email, 50);
        $model->article = $article_id;
        $model->created_at = date('Y-m-d H:i:s');
        $model->status = $model::STATUS_WAITING;
        if (!empty($replyToId)) {
            $model->parent = $replyToId;
        }
        $model->website = Yii::$app->functions->limitText($site, 50);
        if ($model->save()) {
//            Yii::$app->session->addFlash('success', \Yii::t('site', 'دیدگاه شما با موفقیت ثبت شد'));
            return (new self())->attributeLabels()['success_message'];
        } else {
            if (!empty($model->errors)) {
                foreach ($model->errors as $attr => $error) {
                    Yii::$app->session->addFlash('warning', $attr.': '.$error[0][0]);
//                    return false;
                    return (new self())->attributeLabels()['error'];
                }
            } else {
                Yii::$app->session->addFlash('warning', \Yii::t('site', 'خطای نامعلوم در ثبت کامنت'));
//                return false;
                return (new self())->attributeLabels()['error'];
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'              => Yii::t('blog', 'شناسه'),
            'message'         => Yii::t('blog', 'متن دیدگاه'),
            'name'            => Yii::t('blog', 'نام'),
            'email'           => Yii::t('blog', 'ایمیل'),
            'website'         => Yii::t('blog', 'وبسایت'),
            'article'         => Yii::t('blog', 'مقاله'),
            'created_at'      => Yii::t('blog', 'تاریخ ایجاد'),
            'status'          => Yii::t('blog', 'وضعیت'),
            'success_message' => Yii::t('blog', 'دیدگاه شما با موفقیت ثبت شد و پس از بررسی ناظر منتشر خواهد شد'),
            'error'           => Yii::t('blog', 'خطا'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'message',
                    'name',
                    'email',
                    'article',
                    'created_at',
                    'status'
                ],
                'required'
            ],
            [
                [
                    'article',
                    'status'
                ],
                'integer'
            ],
            [
                ['created_at'],
                'safe'
            ],
            [
                ['message'],
                'string',
                'max' => 1000
            ],
            [
                ['name'],
                'string',
                'max' => 255
            ],
            [
                [
                    'email',
                    'website'
                ],
                'string',
                'max' => 100
            ],
            [
                'email',
                'email'
            ]
        ];
    }

    /**
     * @return BlogComment
     */
    public function getArticle0()
    {
        return $this->hasOne(BlogArticles::className(), ['id' => 'article']);
    }
}
