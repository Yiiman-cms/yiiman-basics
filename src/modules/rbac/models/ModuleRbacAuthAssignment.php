<?php

namespace YiiMan\YiiBasics\modules\rbac\models;

use Codeception\Step\Retry;
use YiiMan\YiiBasics\modules\useradmin\models\User;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%module_rbac_auth_assignment}}".
 *
 * @property string $item_name
 * @property string $user_id
 * @property int $created_at
 *
 * @property ModuleRbacAuthItem $itemName
 */
class ModuleRbacAuthAssignment extends ActiveRecord
{
    public $users;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_rbac_auth_assignment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'safe'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
            [['item_name', 'user_id'], 'unique', 'targetAttribute' => ['item_name', 'user_id']],
            ['users', 'safe'],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\rbac\models\ModuleRbacAuthItem::className(), 'targetAttribute' => ['item_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return
            [
                'item_name' => Yii::t('rbac', 'نقش'),
                'user_id' => Yii::t('rbac', 'کاربران'),
                'created_at' => Yii::t('rbac', 'تاریخ ایجاد'),
            ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(ModuleRbacAuthItem::className(), ['name' => 'item_name']);
    }

    public function loadUsers()
    {
        $model = self::find()->select('user_id')->where(['item_name' => $this->item_name])->asArray()->all();
        if (!empty($model)){
            $uids=ArrayHelper::getColumn($model,'user_id');
            $this->users=$uids;
        }
    }
}
