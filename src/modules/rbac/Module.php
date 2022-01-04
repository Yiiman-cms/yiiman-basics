<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Site: https://yiiman.ir
 * AuthorName: gholamreza beheshtian
 * AuthorNumber:+989353466620 | +17272282283
 * AuthorCompany: YiiMan
 */

namespace YiiMan\YiiBasics\modules\rbac;

/**
 * metadata module definition class
 */


use Yii;
use yii\helpers\ArrayHelper;

class Module extends \YiiMan\YiiBasics\lib\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace;
    public $name;
    public $nameSpace;
    public $config = [];
    public $hasComponent = true;

    /**
     * @var string $userModelClassName The user model class.
     * Default it will get from `Yii::$app->getUser()->identityClass`
     */
    public $userModelClassName;

    /**
     * @var string $userModelIdField the id field name of user model.
     * Default is id
     */
    public $userModelIdField = 'id';

    /**
     * @var string $userModelLoginField the login field name of user model.
     * Default is username
     */
    public $userModelLoginField = 'username';

    /**
     * @var string $userModelLoginFieldLabel The login field's label of user model.
     * Default is Username
     */
    public $userModelLoginFieldLabel;

    /**
     * @var array|null $userModelExtraDataColumks the array of extra colums of user model want to show in
     * assignment index view.
     */
    public $userModelExtraDataColumls;

    public $components =
        [
            'authManager' =>
                [
                    'class' => 'YiiMan\YiiBasics\modules\rbac\models\DbManager'
                ]
        ];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if ($this->userModelClassName == null) {
            if (Yii::$app->has('user')) {
                $this->userModelClassName = Yii::$app->user->identityClass;
            } else {
                throw new yii\base\Exception("You must config user compoment both console and web config");
            }
        }
        if ($this->userModelLoginFieldLabel == null) {
            $model = new $this->userModelClassName;
            $this->userModelLoginFieldLabel = $model->getAttributeLabel($this->userModelLoginField);
        }
    }

    public static function menus()
    {
        return
            [
                [
                    'title' => 'مدیریت دسترسی ها',
                    'items' =>
                        [
                            [
                                'title' => 'برورزرسانی دسترسی ها',
                                'url'   => 'rbac/create-permissions'
                            ],
                            [
                                'title' => 'تخصیص دسترسی ها',
                                'url'   => 'rbac/assignment'
                            ],
                            [
                                'title' => 'نقش ها',
                                'url'   => 'rbac/role'
                            ]
                        ]
                ]
            ];
    }
}
