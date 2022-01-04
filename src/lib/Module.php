<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib;

/**
 * menu module definition class
 */


use Yii;
use yii\base\Event;
use yii\helpers\ArrayHelper;
use YiiMan\Setting\module\models\DynamicModel;


class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace;
    public $name;
    public $config = [];

    public $hasMigration = false;
    public $hasModules = false;
    public $hasComponent = false;
    public $components = [];

    /**
     * if you want create setting tab you should return array like this:
     * 
     * [
     *      'tabTitle'=>function($form){return 'rendered view';},
     * 
     *      Yii::t('sessions', 'Our tab title')=>function($form){
     *          return Yii::$app->view->render('path/to.php',['form'=>$form]);
     *      } 
     * ]
     * 
     * @return array
     */
    public static function settings()
    {
        return [];
    }

    /**
     * if you want set admin menu for this modules,then you should return array like this:
     * 
     * [
     * 
     *      [
     *          'title' => 'Title',
     *          'url'   => 'moduleName/index',
     *          'icon'  => 'material-icon'
     *      ],
     *      [
     *          'title' => 'Title2',
     *          'url'   => 'moduleName/index2',
     *          'icon'  => 'material-icon',
     *          'items' =>
     *                  [
     *                      [
     *                            'title' => 'Title',
     *                            'url'   => 'moduleName/index3',
     *                            'icon'  => 'material-icon'
     *                      ],
     *                      [
     *                            'title' => 'Title2',
     *                            'url'   => 'moduleName/index3',
     *                            'icon'  => 'material-icon'
     *                      ],
     * 
     *                  ]
     *      ]
     * 
     * ]
     * 
     * 
     * 
     * @return array
     */
    public static function menus(){
        return [];
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

    /**
     * {@inheritdoc}
     */
    public function init()
    {

//        $this->controllerNamespace = 'YiiMan\YiiBasics\modules\\'.$this->config['name'].'\controllers';


        $this->initI18N();
        $this->registerTranslations();

        if ($this->hasModules) {
            $this->initModules();
        }
        if ($this->hasMigration) {
            $this->initMigrations();
        }
        if ($this->hasComponent) {
            $this->initComponents();
        }

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
                $config = [
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

    protected function registerTranslations()
    {
        Yii::$app->i18n->translations[$this->name] = [
            'class'          => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => Yii::$app->language,
            'basePath'       => __DIR__.'/messages',
            'fileMap'        => [
                $this->name => 'module.php',
            ],
        ];
    }

    public function initComponents()
    {
        Yii::$app->setComponents($this->components);
    }


    public static function initSetting()
    {
        $settings = self::settings();

        if (!empty($settings)) {
            foreach ($settings as $tabTitle => $contentCallBack) {
                $tabID = 'tab'.uniqid();
                Event::on(Triggers::className(), Triggers::AFTER_SETTINGS_TAB, function () use ($tabTitle, $tabID) {
                    echo '<li>
				<a href="#'.$tabID.'" data-toggle="tab">'.$tabTitle.'</a>
          </li>';
                });
                Event::on(Triggers::className(), Triggers::AFTER_SETTINGS_TAB_CONTENT,
                    function () use ($contentCallBack, $tabID) {
                        $model = DynamicModel::getInstans();
                        $form = $model::getForm();
                        echo '<div class="tab-pane" id="'.$tabID.'">';
                        echo $contentCallBack($form);
                        echo '</div>';
                    });
            }
        }
    }
    
    public static function initMenus(){
        Event::on(
            Triggers::className(),
            Triggers::EVENT_AFTER_MENU,
            function () use ($conf) {
                $adminURl=$_ENV['SiteAdminURL'];
                $menu = $conf['menu'];
                if (empty($menu['items'])) {
                    $title = $conf['menu']['title'];
                    $url = $conf['url'];
                    if (empty($conf['menu']['icon'])) {
                        $icon = 'trip_origin';
                    } else {
                        $icon = $conf['menu']['icon'];
                    }
                    
                    echo <<<EOT
				<li class="nav-item">
                        <a class="nav-link " href="/$adminURl/$url" aria-expanded="false"><i class="material-icons">$icon</i><p>$title</p>
                        </a>
                        </li>
EOT;


                } else {
                    $title = $conf['menu']['title'];
                    $name = 'name'.uniqid();
                    if (empty($conf['menu']['icon'])) {
                        $icon = 'trip_origin';
                    } else {
                        $icon = $conf['menu']['icon'];
                    }
                    if (!empty($conf['menu']['title'])) {
                        echo <<<EOT

<li class="nav-item">
	<a class="nav-link collapsed" href="#$name" data-toggle="collapse" aria-expanded="false"><i class="material-icons">$icon</i><p>$title<b class="caret"></b></p></a>
	<div class="collapse" id="$name" style="">
		<ul class="nav">
EOT;

                        foreach ($menu['items'] as $item) {
                            $sURL = $item['url'];
                            $sTitle = $item['title'];
                            if (empty($item['icon'])) {
                                $sIcon = 'trip_origin';
                            } else {
                                $sIcon = $item['icon'];
                            }
                            echo <<<EOT
			<li class="nav-item">
				<a class="nav-link" href="/$adminURl/$sURL">
					<i class="material-icons">$sIcon</i>
					<p class="sidebar-normal">$sTitle</p>
				</a>
			</li>
			
EOT;
                        }
                        echo <<<EOT
		
		</ul>
	</div>
</li>
EOT;
                    }


                }


            }
        );
    }
}
