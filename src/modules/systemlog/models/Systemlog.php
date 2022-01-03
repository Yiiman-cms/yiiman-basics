<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\systemlog\models;

use YiiMan\YiiBasics\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "{{%module_systemlog}}".
 * @property int                                             $id
 * @property int                                             $level      سطح
 * @property string                                          $category   دسته
 * @property string                                          $log_time   زمان ثبت
 * @property string                                          $prefix     پیشوند
 * @property string                                          $message    پیام
 * @property int                                             $language
 * @property int                                             $language_parent
 * @property string                                          $ip         آی پی
 * @property int                                             $uid        کاربر
 * @property string                                          $session_id شناسه ی نشست
 * @property string                                          $app_name   نام برنامه
 * @property                                                 $session_details
 * @property                                                 $last_error
 * @property User                                            $u
 * @property \YiiMan\YiiBasics\modules\useradmin\models\User $u0
 */
class Systemlog extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_systemlog}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'level',
                    'language',
                    'language_parent',
                    'uid'
                ],
                'integer'
            ],
            [
                ['log_time'],
                'safe'
            ],
            [
                [
                    'prefix',
                    'message'
                ],
                'string'
            ],
            [
                [
                    'category',
                    'session_id'
                ],
                'string',
                'max' => 255
            ],
            [
                ['ip'],
                'string',
                'max' => 30
            ],
            [
                ['app_name'],
                'string',
                'max' => 50
            ],
            [
                ['uid'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => \YiiMan\YiiBasics\modules\user\models\User::className(),
                'targetAttribute' => ['uid' => 'id']
            ],
            [
                ['uid'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => \YiiMan\YiiBasics\modules\user\models\UserAdmin::className(),
                'targetAttribute' => ['uid' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'              => Yii::t('systemlog', 'ID'),
            'level'           => Yii::t('systemlog', 'سطح'),
            'category'        => Yii::t('systemlog', 'دسته'),
            'log_time'        => Yii::t('systemlog', 'زمان ثبت'),
            'prefix'          => Yii::t('systemlog', 'پیشوند'),
            'message'         => Yii::t('systemlog', 'پیام'),
            'language'        => Yii::t('systemlog', 'Language'),
            'language_parent' => Yii::t('systemlog', 'Language Parent'),
            'ip'              => Yii::t('systemlog', 'آی پی'),
            'uid'             => Yii::t('systemlog', 'کاربر'),
            'session_id'      => Yii::t('systemlog', 'شناسه ی نشست'),
            'app_name'        => Yii::t('systemlog', 'نام برنامه'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU0()
    {
        return $this->hasOne(UserAdmin::className(), ['id' => 'uid']);
    }
}
