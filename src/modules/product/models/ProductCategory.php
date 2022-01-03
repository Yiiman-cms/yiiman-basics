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
 * This is the model class for table "{{%module_product_category}}".
 * @property int               $id
 * @property string            $title
 * @property int               $parent
 * @property ProductCategory   $parent0
 * @property ProductCategory[] $productCategories
 */
class ProductCategory extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_product_category}}';
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
            [
                ['title'],
                'string',
                'max' => 255
            ],
            [
                ['parent'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => \YiiMan\YiiBasics\modules\product\models\ProductCategory::className(),
                'targetAttribute' => ['parent' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'     => Yii::t('product', 'ID'),
            'title'  => Yii::t('product', 'موضوع گروه'),
            'parent' => Yii::t('product', 'گروه مادر'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::className(), ['parent' => 'id']);
    }
}
