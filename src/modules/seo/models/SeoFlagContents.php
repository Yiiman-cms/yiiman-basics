<?php

namespace YiiMan\YiiBasics\modules\seo\models;

use YiiMan\YiiBasics\lib\ActiveRecord;
use Yii;
use yii\validators\UrlValidator;

/**
 * This is the model class for table "{{%module_seo_flag_contents}}".
 *
 * @property int $id شناسه ی خصوصی
 * @property string $title موضوع
 * @property string $full_content توضیحات کامل
 * @property string $short_content توضیح کوتاه
 * @property int $status وضعیت انتشار
 * @property string $slug نامک
 */
class SeoFlagContents extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_seo_flag_contents}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['full_content'], 'string'],
            [['status','language'], 'integer'],
            [['link'], UrlValidator::className()],
            [['title'], 'string', 'max' => 255],
            [['short_content'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('seo', 'شناسه ی خصوصی'),
            'link' => Yii::t('seo', 'لینک'),
            'title' => Yii::t('seo', 'کلیدواژه'),
            'short_content' => Yii::t('seo', 'توضیح کوتاه'),
            'status' => Yii::t('seo', 'وضعیت انتشار'),
        ];
    }

    public function attributeHints()
    {
        return
            [
                'title'=>  \Yii::t('seo','کلیدواژه ای که قصد دارید در هر جای سایت که مشاهده شد، درباره ی آن توضیحی داده شود را بنویسید'),
                'short_content'=>  \Yii::t('site','توضیحات مورد نظر خود در رابطه با کلیدواژه را درج نمایید'),
                'link' => Yii::t('seo', 'این کلیدواژه به کجا لینک شود؟'),
            ];
    }
}
