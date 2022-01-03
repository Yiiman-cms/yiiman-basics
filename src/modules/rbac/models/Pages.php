<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\rbac\models;

use Yii;

/**
 * This is the model class for table "{{%pages}}".
 * @property integer $id
 * @property string  $name
 * @property string  $desc
 * @property string  $register_time
 * @property integer $status_id
 * @property integer $user_id
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_rbac_pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'name',
                    'desc',
                    'register_time',
                    'status_id',
                    'user_id'
                ],
                'required'
            ],
            [
                [
                    'id',
                    'status_id',
                    'user_id'
                ],
                'integer'
            ],
            [
                ['register_time'],
                'safe'
            ],
            [
                [
                    'name',
                    'desc'
                ],
                'string',
                'max' => 255
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('rbac', 'Id'),
            'name'          => Yii::t('rbac', 'Name'),
            'desc'          => Yii::t('rbac', 'Description'),
            'register_time' => Yii::t('rbac', 'register time'),
            'status_id'     => Yii::t('rbac', 'status'),
            'user_id'       => Yii::t('rbac', 'user'),
        ];
    }

}
