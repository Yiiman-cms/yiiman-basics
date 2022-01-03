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
 *
 *
 */
namespace YiiMan\YiiBasics\modules\api;

use Yii;
use yii\helpers\ArrayHelper;

class Module extends \yii\base\Module{

    public $controllerNamespace='YiiMan\YiiBasics\modules\api\controllers';
    public $name='api';
    public $nameSpace='YiiMan\YiiBasics\modules\api';
	public $config=
		[
			'type'      => [ 'backend', 'common' ],
			'namespace' => 'YiiMan\YiiBasics\modules\api',
			'sourceLanguage' => 'fa',
			'address'     => '',
			'menu'        =>
				[
					'test' =>
						[
							'sub-menu' => 'controller/action'
						]
				],
			'message'     =>
				[
					'app-name',
					'app-name-2'
				],

		];
    public function init(){

        $this->initModules();

    }
 
    public function initComponents(){
        $Option=
            [
//                'class'=>'YiiMan\YiiBasics\modules\api\components\Options',
            ];


        //Yii::$app->components['pdf']= $pdf;
        Yii::$app->setComponents([$Option]);
    }

    public function initModules(){
    	if (!empty( $this->config['modules'])){

		    foreach ($this->config['modules'] as $key => $val){
		    	$this->modules[$key]=$val;
		    }
	    }
    }

    public function initMigrations(){
	   $classes= getFileList( realpath( __DIR__.'/migrations'));
	   if (!empty( $classes)){
	   	foreach ($classes as  $key => $val){
	   		if ($val['type']=='text/x-php'){
	   			$val['name']=str_replace( '.php', '', $val['name']);
	   			$cname=$this->nameSpace.'\migrations\\'. $val['name'];
			   $class= new $cname();
			   try{
				   $generate=$class->safeUp();
			   }catch (\Exception $e){
			   }

			   
	   		}

	    }
	   }

	   
    }
	/**
	 * Translates a message. This is just a wrapper of Yii::t
	 *
	 * @see Yii::t
	 *
	 * @param $category
	 * @param $message
	 * @param array $params
	 * @param null $language
	 * @return string
	 */
	public static function t($category, $message, $params = [], $language = null)
	{
		return Yii::t( $category, $message, $params, $language);
	}
}
