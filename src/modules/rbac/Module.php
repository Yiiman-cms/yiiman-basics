<?php
/*
 * Copyright (c) 2022.
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

class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace;
    public $name;
    public $nameSpace;
    public $config = [];

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

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        // < set Class Parameters >
        {
            $this->config = include realpath(__DIR__.'/config.php');
            $this->nameSpace = 'YiiMan\YiiBasics\modules\\'.$this->config['name'];
            $this->controllerNamespace = 'YiiMan\YiiBasics\modules\\'.$this->config['name'].'\controllers';
            $this->name = $this->config['name'];

        }
        // </ set Class Parameters >

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

        $this->initI18N();
        $this->initModules();
        $this->initMigrations();
        $this->registerTranslations();
        $this->initComponents();
    }


    /**
     * TranslationTrait manages methods for all translations used in Krajee extensions
     * @author Kartik Visweswaran <kartikv2@gmail.com>
     * @return void
     * @since  1.8.8
     *         Yii i18n messages configuration for generating translations
     *         source : https://github.com/kartik-v/yii2-krajee-base/blob/master/TranslationTrait.php
     *         Edited by : Yohanes Candrajaya <moo.tensai@gmail.com>
     * @property array $i18n
     */
    public function initI18N()
    {
        $reflector = new \ReflectionClass(get_class($this));
        $dir = dirname($reflector->getFileName());

        if (!empty($this->config['message'])) {
            foreach ($this->config['message'] as $message) {
                Yii::setAlias("@".$message, $dir);
                $config =
                    [
                        'class'            => 'yii\i18n\PhpMessageSource',
                        'basePath'         => "@".$message."/messages",
                        'forceTranslation' => true
                    ];
                $globalConfig = ArrayHelper::getValue(Yii::$app->i18n->translations, $message."*", []);
                if (!empty($globalConfig)) {
                    $config = array_merge(
                        $config,
                        is_array($globalConfig) ? $globalConfig : (array) $globalConfig
                    );
                }
                Yii::$app->i18n->translations[$message."*"] = $config;
            }
        }

    }

    protected function registerTranslations()
    {
        Yii::$app->i18n->translations[$this->name] = [
            'class'          => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => Yii::$app->language,
            'basePath'       => '@system/modules/'.$this->name.'/messages',
            'fileMap'        => [
                $this->name => 'module.php',
            ],
        ];
    }

    public function initComponents()
    {
        $Option =
            [
//					'class' => 'YiiMan\Setting\module\components\Options' ,
        ];

//			Yii::$app->components['authManager']=
//			[
//				'class'=>'YiiMan\YiiBasics\module\rbac\models\DbManager'
//			];
        Yii::$app->setComponents(
            [
                'authManager' =>
                    [
                        'class' => 'YiiMan\YiiBasics\modules\rbac\models\DbManager'
                    ]
            ]
        );
    }

    public function initModules()
    {
        if (!empty($this->config['modules'])) {

            foreach ($this->config['modules'] as $key => $val) {
                $this->modules[$key] = $val;
            }
        }
    }

    public function initMigrations()
    {
        $classes = getFileList(realpath(__DIR__.'/migrations'));
        if (!empty($classes)) {
            foreach ($classes as $key => $val) {
                if ($val['type'] == 'text/x-php') {
                    $val['name'] = str_replace('.php', '', $val['name']);
                    $cname = $this->nameSpace.'\migrations\\'.$val['name'];
                    $class = new $cname();
                    try {
                        $generate = $class->safeUp();
                    } catch (\Exception $e) {
                    }


                }

            }
        }


    }

    /**
     * Translates a message. This is just a wrapper of Yii::t
     * @param         $category
     * @param         $message
     * @param  array  $params
     * @param  null   $language
     * @return string
     * @see Yii::t
     */
    public static function t($category, $message, $params = [], $language = null)
    {

        return Yii::t($category, $message, $params, $language);
    }
}
