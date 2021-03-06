<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\product\models;

use Yii;

/**
 * This is the model class for table "{{%module_product}}".
 * @property int    $id
 * @property string $hash
 * @property string $title
 * @property string $sub_title
 * @property string $description
 * @property int    $status
 * @property string $code
 * @property string $unit
 * @property double $weight
 * @property double $discount
 * @property int    $hit
 * @property int    $sold
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
            [
                [
                    'title',
                    'sub_title',
                    'description',
                    'status',
                    'unit',
                    'created_at',
                    'updated_at'
                ],
                'required'
            ],
            [
                [
                    'description',
                    'json_data'
                ],
                'string'
            ],
            [
                [
                    'status',
                    'hit',
                    'sold'
                ],
                'integer'
            ],
            [
                [
                    'weight',
                    'discount'
                ],
                'number'
            ],
            [
                [
                    'created_at',
                    'updated_at'
                ],
                'safe'
            ],
            [
                [
                    'hash',
                    'title',
                    'code',
                    'unit'
                ],
                'string',
                'max' => 255
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('product', '??????????'),
            'hash'        => Yii::t('product', '????'),
            'title'       => Yii::t('product', '?????? ??????????'),
            'sub_title'   => Yii::t('product', '???????? ??????????'),
            'description' => Yii::t('product', '?????????????? ??????????'),
            'status'      => Yii::t('product', '??????????'),
            'code'        => Yii::t('product', '???? ??????????'),
            'unit'        => Yii::t('product', '???????? ??????????'),
            'weight'      => Yii::t('product', '??????(??????)'),
            'discount'    => Yii::t('product', '??????????(????????)'),
            'hit'         => Yii::t('product', '?????????? ????????????'),
            'sold'        => Yii::t('product', '?????????? ????????'),
            'created_at'  => Yii::t('product', '?????????? ??????????'),
            'updated_at'  => Yii::t('product', '?????????? ??????????????????'),
            'json_data'   => Yii::t('product', '?????????????? ??????????'),
        ];
    }
}
