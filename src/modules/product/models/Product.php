<?php

namespace YiiMan\YiiBasics\modules\product\models;

use Yii;

/**
 * This is the model class for table "{{%module_product}}".
 *
 * @property int $id
 * @property string $hash
 * @property string $title
 * @property string $sub_title
 * @property string $description
 * @property int $status
 * @property string $code
 * @property string $unit
 * @property double $weight
 * @property double $discount
 * @property int $hit
 * @property int $sold
 * @property string $created_at
 * @property string $updated_at
 * @property string $json_data
 */
class Product extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'title','sub_title', 'description', 'status', 'unit', 'created_at', 'updated_at'], 'required'],
            [['description', 'json_data'], 'string'],
            [['status', 'hit', 'sold'], 'integer'],
            [['weight', 'discount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['hash', 'title', 'code', 'unit'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('product', 'شناسه'),
            'hash' => Yii::t('product', 'هش'),
            'title' => Yii::t('product', 'نام محصول'),
            'sub_title' => Yii::t('product', 'جملک محصول'),
            'description' => Yii::t('product', 'توضیحات محصول'),
            'status' => Yii::t('product', 'وضعیت'),
            'code' => Yii::t('product', 'کد محصول'),
            'unit' => Yii::t('product', 'واحد شمارش'),
            'weight' => Yii::t('product', 'وزن(گرم)'),
            'discount' => Yii::t('product', 'تخفیف(درصد)'),
            'hit' => Yii::t('product', 'تعداد بازدید'),
            'sold' => Yii::t('product', 'تعداد خرید'),
            'created_at' => Yii::t('product', 'تاریخ ایجاد'),
            'updated_at' => Yii::t('product', 'تاریخ بروزرسانی'),
            'json_data' => Yii::t('product', 'اطلاعات اضافی'),
        ];
    }
}
