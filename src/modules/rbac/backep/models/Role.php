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
 * This is the model class for table "{{%role}}".
 * @property integer $id
 * @property string  $name
 * @property string  $description
 * @property string  $RegisterTime
 * @property integer $status
 */
class Role extends \yii\db\ActiveRecord
{
    public $access;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_rbac_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'name',
                    'description'
                ],
                'required'
            ],
            [
                [
                    'id',
                    'status'
                ],
                'integer'
            ],
            [
                ['description'],
                'string'
            ],
            [
                ['RegisterTime'],
                'safe'
            ],
            [
                ['name'],
                'string',
                'max' => 50
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
                'id'           => Yii::t('role', 'Role - ID'),
                'name'         => Yii::t('role', 'Role - Name'),
                'description'  => Yii::t('role', 'Role - Description'),
                'RegisterTime' => Yii::t('role', 'Role - Register Time'),
                'status'       => Yii::t('role', 'Role - Status'),
                'access'       => Yii::t('role', 'Role - access'),
            ];
    }
}
