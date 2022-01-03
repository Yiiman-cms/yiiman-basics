<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\logs\models;

use Yii;

/**
 * This is the model class for table "{{%module_systemlog}}".
 * @property int    $id
 * @property int    $level    سطح
 * @property string $category دسته
 * @property double $log_time زمان ثبت
 * @property string $prefix   پیشوند
 * @property string $message  پیام
 */
class ModuleSystemlog extends \YiiMan\YiiBasics\lib\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_systemlog}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return
            [
                [
                    ['level'],
                    'integer'
                ],
                [
                    ['log_time'],
                    'number'
                ],
                [
                    [
                        'prefix',
                        'message'
                    ],
                    'string'
                ],
                [
                    ['category'],
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
        return
            [
                'id'       => Yii::t('log', 'ID'),
                'level'    => Yii::t('log', 'سطح'),
                'category' => Yii::t('log', 'دسته'),
                'log_time' => Yii::t('log', 'زمان ثبت'),
                'prefix'   => Yii::t('log', 'پیشوند'),
                'message'  => Yii::t('log', 'پیام'),
            ];
    }
}
