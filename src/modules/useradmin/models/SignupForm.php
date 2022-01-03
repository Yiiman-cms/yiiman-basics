<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\useradmin\models;

use common\models\Agency;
use common\models\Neighbourhoods;
use YiiMan\YiiBasics\modules\useradmin\models\User;
use Yii;
use yii\base\Model;
use common\models\Provinces;
use common\models\Cities;

class SignupForm extends Model
{
    public $fullname;
    public $email;
    public $username;
    public $password;
    public $phone;

    public function rules()
    {
        return [
            [
                'username',
                'unique',
                'targetClass' => User::className(),
                'message'     => Yii::t('base', 'این شماره همراه قبلا ثبت شده است.')
            ],
            [
                'username',
                'trim'
            ],
            [
                'username',
                'required'
            ],
            [
                'username',
                'number',
                'min' => 10,
                'max' => 15
            ],

            [
                'password',
                'required'
            ],
            [
                'password',
                'string',
                'min' => 6,
                'max' => 255
            ],
            [
                [
                    'name',
                    'family'
                ],
                'string',
                'min' => 3,
                'max' => 30,
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('base', 'شماره همراه'),
            'password' => Yii::t('base', 'رمز عبور'),
            'name'     => 'نام',
            'family'   => 'نام خانوادگی'
        ];
    }


}
