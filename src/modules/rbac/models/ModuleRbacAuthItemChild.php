<?php

namespace YiiMan\YiiBasics\modules\rbac\models;

use Yii;
use yii\db\ActiveRecord;

/**
* This is the model class for table "{{%module_rbac_auth_item_child}}".
*
    * @property string $parent
    * @property string $child
    *
            * @property RbacAuthItem $parent0
            * @property RbacAuthItem $child0
    */
class ModuleRbacAuthItemChild extends ActiveRecord
{


/**
* {@inheritdoc}
*/
public static function tableName()
{
return '{{%module_rbac_auth_item_child}}';
}

/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent', 'child'], 'unique', 'targetAttribute' => ['parent', 'child']],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' =>\YiiMan\YiiBasics\modules\rbac\models\ModuleRbacAuthItem::className(), 'targetAttribute' => ['parent' => 'name']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' =>\YiiMan\YiiBasics\modules\rbac\models\ModuleRbacAuthItem::className(), 'targetAttribute' => ['child' => 'name']],
        ];
}

/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
    'parent' => Yii::t('rbac', 'Parent'),
    'child' => Yii::t('rbac', 'Child'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getParent0()
    {
    return $this->hasOne(ModuleRbacAuthItem::className(), ['name' => 'parent']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getChild0()
    {
    return $this->hasOne(ModuleRbacAuthItem::className(), ['name' => 'child']);
    }
}
