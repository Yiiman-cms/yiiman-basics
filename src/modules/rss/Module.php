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
namespace YiiMan\YiiBasics\modules\rss;


use Yii;
use yii\helpers\ArrayHelper;

class Module extends \yii\base\Module{

    public $controllerNamespace='YiiMan\YiiBasics\modules\rss\controllers';
    public $name='api';
    public $nameSpace='YiiMan\YiiBasics\modules\rss';
	public $config=
		[
			'type'      => [ 'common' ],
			'namespace' => 'YiiMan\YiiBasics\modules\rss',
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
    
}
