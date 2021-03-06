<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\useradmin\models;

use YiiMan\YiiBasics\modules\useradmin\models\User;
use Yii;
use yii\base\Model;
use common\models\Users;

class ChangePassword extends Model
{
    public $user;
    public $old_password;
    public $new_password;
    public $new_password_repeat;

    public function __construct($id)
    {

        $model = User::find()
            ->where([
                'id' => $id,
            ])
            ->one();

        if ($model === null) {
            throw new NotFoundHttpException(Yii::t('base', 'The requested page does not exist.'));
        }

        $this->user = $model;
        parent::__construct();
    }

    public function rules()
    {
        return [
            [
                [
                    'old_password',
                    'new_password',
                    'new_password_repeat'
                ],
                'required'
            ],
            [
                [
                    'old_password',
                    'new_password',
                    'new_password_repeat'
                ],
                'string',
                'min' => 6,
                'max' => 255
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'old_password' => Yii::t('base', 'Old Password'),
            'new_password' => Yii::t('base', 'New Password'),
            'new_password_repeat' => Yii::t('base', 'New Password Repeat'),
        ];
    }

    public function compare($id)
    {
        if ($id == 1) {
            return Yii::$app->security->validatePassword($this->old_password, $this->user->password_hash);
        }
        return $this->new_password == $this->new_password_repeat;
    }

    public function setNewPassword()
    {
        $this->user->password_hash = Yii::$app->security->generatePasswordHash($this->new_password);
        return $this->user->save();
    }
}
