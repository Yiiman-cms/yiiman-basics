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
use yii\rbac\Item;

/**
 * @author John Martin <john.itvn@gmail.com>
 * @since  1.0.0
 */
class Role extends AuthItem
{

    public $permissions = [];

    public static function find($name)
    {
        $authManager = Yii::$app->authManager;
        $item = $authManager->getRole($name);

        return new self($item);
    }

    public function init()
    {
        parent::init();
        if (!$this->isNewRecord) {
            $permissions = [];
            foreach (static::getPermistions($this->name) as $permission) {
                $permissions[] = $permission->name;
            }
            $this->permissions = $permissions;
        }
    }

    public static function getPermistions($name)
    {
        $authManager = Yii::$app->authManager;

        return $authManager->getPermissionsByRole($name);
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['default'][] = 'permissions';

        return $scenarios;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $authManager = Yii::$app->authManager;
        $role = $authManager->getRole($this->item->name);
        if (!$insert) {
            $authManager->removeChildren($role);
        }
        if ($this->permissions != null && is_array($this->permissions)) {
            foreach ($this->permissions as $permissionName) {
                $permistion = $authManager->getPermission($permissionName);
                $authManager->addChild($role, $permistion);
            }
        }
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['name'] = Yii::t('rbac', 'Role name');
        $labels['permissions'] = Yii::t('rbac', 'Permissions');

        return $labels;
    }

    protected function getType()
    {
        return Item::TYPE_ROLE;
    }

}
