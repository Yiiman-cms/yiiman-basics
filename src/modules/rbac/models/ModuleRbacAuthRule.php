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
use \YiiMan\YiiBasics\modules\rbacauthitem\models\RbacAuthItem;

/**
 * This is the model class for table "{{%module_rbac_auth_rule}}".
 * @property string         $name
 * @property resource       $data
 * @property int            $created_at
 * @property int            $updated_at
 * @property RbacAuthItem[] $rbacAuthItems
 */
class ModuleRbacAuthRule extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_rbac_auth_rule}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['name'],
                'required'
            ],
            [
                ['data'],
                'string'
            ],
            [
                [
                    'created_at',
                    'updated_at'
                ],
                'integer'
            ],
            [
                ['name'],
                'string',
                'max' => 64
            ],
            [
                ['name'],
                'unique'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name'       => Yii::t('rbac', 'Name'),
            'data'       => Yii::t('rbac', 'Data'),
            'created_at' => Yii::t('rbac', 'Created At'),
            'updated_at' => Yii::t('rbac', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRbacAuthItems()
    {
        return $this->hasMany(RbacAuthItem::className(), ['rule_name' => 'name']);
    }
}
