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
use yii\base\Model;

/**
 * @author John Martin <john.itvn@gmail.com>
 * @since  1.0.0
 */
class AssignmentForm extends Model
{

    public $userId;
    public $roles = [];
    public $authManager;

    /**
     * @param  mixed  $userId  The id of user use for assign
     * @param  array  $config
     */
    public function __construct($userId, $config = [])
    {
        parent::__construct($config);
        $this->userId = $userId;
        $this->authManager = Yii::$app->authManager;
        foreach ($this->authManager->getRolesByUser($userId) as $role) {
            $this->roles[] = $role->name;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return
            [
                [
                    ['userId'],
                    'required'
                ],
                [
                    ['roles'],
                    'default'
                ],
            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => Yii::t('rbac', 'User ID'),
            'roles'  => Yii::t('rbac', 'Roles'),
        ];
    }

    /**
     * Save assignment data
     * @return boolean whether assignment save success
     */
    public function save()
    {
        $this->authManager->revokeAll(intval($this->userId));
        if ($this->roles != null) {
            foreach ($this->roles as $role) {
                $this->authManager->assign($this->authManager->getRole($role), $this->userId);
            }
        }

        return true;
    }

}
