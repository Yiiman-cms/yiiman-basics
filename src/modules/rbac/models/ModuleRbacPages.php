<?php

namespace YiiMan\YiiBasics\modules\rbac\models;

use Yii;
/**
* This is the model class for table "{{%module_rbac_pages}}".
*
    * @property int $id
    * @property string $name
    * @property string $desc
    * @property string $register_time
    * @property int $status_id
    * @property int $user_id
*/
class ModuleRbacPages extends \YiiMan\YiiBasics\lib\ActiveRecord
{
const STATUS_ACTIVE=1;
const STATUS_DE_ACTIVE=0;

/**
* {@inheritdoc}
*/
public static function tableName()
{
return '{{%module_rbac_pages}}';
}

/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['name', 'desc', 'register_time', 'status_id', 'user_id'], 'required'],
            [['register_time'], 'safe'],
            [['status_id', 'user_id'], 'integer'],
            [['name', 'desc'], 'string', 'max' => 255],
        ];
}

/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('rbac', 'ID'),
    'name' => Yii::t('rbac', 'Name'),
    'desc' => Yii::t('rbac', 'Desc'),
    'register_time' => Yii::t('rbac', 'Register Time'),
    'status_id' => Yii::t('rbac', 'Status ID'),
    'user_id' => Yii::t('rbac', 'User ID'),
];
}
}
