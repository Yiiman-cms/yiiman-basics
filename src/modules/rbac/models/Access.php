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
 * This is the model class for table "{{%access}}".
 * @property integer $id
 * @property integer $role_id
 * @property integer $page_id
 */
class Access extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%module_rbac_access}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'role_id',
                    'page_id'
                ],
                'required'
            ],
            [
                [
                    'role_id',
                    'page_id'
                ],
                'integer'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return
            [
                'id' => Yii::t('rbac', 'Id'),
                'role_id' => Yii::t('rbac', 'role Id'),
                'page_id' => Yii::t('rbac', 'page Id'),
            ];
    }
}
