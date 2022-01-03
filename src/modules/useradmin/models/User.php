<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\useradmin\models;

use yii\behaviors\TimestampBehavior;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use YiiMan\YiiBasics\lib\ActiveRecord;
use Yii;


/**
 * User model
 * @property integer $id
 * @property string  $username
 * @property string  $password_hash
 * @property string  $password_reset_token
 * @property string  $email
 * @property string  $auth_key
 * @property string  $nickName
 * @property string  $bio
 * @property integer $status
 * @property integer $superadmin
 * @property integer $created_at
 * @property integer $updated_at
 * @property string  $password write-only password
 * @property string  $verification
 * @property string  $image
 */
class User extends ActiveRecord implements IdentityInterface
{

    const STATUS_DE_ACTIVE = 0;
    const STATUS_ACTIVE = 10;
    public $password;
    public $_access = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_user_admin}}';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne([
            'id'     => $id,
            'status' => self::STATUS_ACTIVE
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     * @param  string  $email
     * @return \common\models\User|null
     */
    public static function findByEmail($email)
    {
        return static::findOne([
            'email'  => $email,
            'status' => self::STATUS_ACTIVE
        ]);
    }

    /**
     * Finds user by password reset token
     * @param  string  $token  password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne(
            [
                'password_reset_token' => $token,
                'status'               => self::STATUS_ACTIVE,
            ]
        );
    }

    /**
     * Finds out if password reset token is valid
     * @param  string  $token  password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];

        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return
            [
                [
                    ['status'],
                    'integer'
                ],
                [
                    ['email'],
                    'trim'
                ],
                [
                    ['nickName'],
                    'string',
                    'max' => 50
                ],
                [
                    ['email'],
                    'email'
                ],
                [
                    ['email'],
                    'string',
                    'max' => 255
                ],
                [
                    ['image'],
                    'file'
                ],
                [
                    ['password'],
                    'string',
                    'max' => 30,
                    'min' => 6
                ]
            ];
    }

    public function attributeLabels()
    {

        return [
            'username' => 'Username',
            'nickName' => \Yii::t('useradmin', 'نام نمایشی'),
            'email'    => \Yii::t('useradmin', 'ایمیل'),
            'password' => \Yii::t('useradmin', 'رمز عبور'),
            'status'   => \Yii::t('useradmin', 'وضعیت'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates password
     * @param  string  $password  password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     * @param  string  $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString().'_'.time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

}
