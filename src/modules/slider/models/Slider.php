<?php

namespace YiiMan\YiiBasics\modules\slider\models;

use Yii;
use yii\validators\UrlValidator;

/**
 * This is the model class for table "{{%module_slider}}".
 *
 * @property int $id
 * @property string $title
 * @property int $index
 * @property int $status
 * @property string $data
 * @property string $title2
 * @property integer $topMargin
 * @property string $linkDescription
 * @property string $link
 */
class Slider extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_slider}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'status'], 'required'],
            [['index', 'status','topMargin'], 'integer'],
            [['data'], 'safe'],
            [['title', 'title2', 'link','linkDescription'], 'string', 'max' => 255],
            [['link'], UrlValidator::className()]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('slider', 'ID'),
            'title' => Yii::t('slider', 'عنوان اسلاید'),
            'index' => Yii::t('slider', 'ترتیب اسلایدر'),
            'status' => Yii::t('slider', 'وضعیت انتشار'),
            'title2' => Yii::t('slider', 'توضیح عنوان'),
            'topMargin' => Yii::t('slider', 'فاصله از بالا'),
            'link' => Yii::t('slider', 'آدرس لینک'),
            'linkDescription' => Yii::t('slider', 'عنوان لینک'),
            'data' => Yii::t('slider', 'محتوای اسلاید'),
        ];
    }

    public function attributeHints()
    {
        return
            [
                'link' => \Yii::t('slider', 'اختیاری')
            ];
    }
}
