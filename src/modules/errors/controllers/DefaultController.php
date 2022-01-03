<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\errors\controllers;
	use Yii;
	use yii\web\Controller;
	
	/**
	 * Created by YiiMan TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:+989353466620 | +17272282283
	 *
	 * Site:https://yiiman.ir
	 * Date: 12/14/2018
	 * Time: 7:56 PM
	 */
	
	class DefaultController extends \YiiMan\YiiBasics\lib\Controller {
		public function actions() {
			if (!empty( Yii::$app->Options) && !empty( Yii::$app->Options->errorTheme)){
				$view='@system/modules/errors/themes/'.Yii::$app->Options->errorTheme.'/views/default/error.php';
				$layout='@system/modules/errors/themes/'.Yii::$app->Options->errorTheme.'/views/layout/main.php';
			}else{
				$view='@system/modules/errors/themes/one/views/default/error.php';
				$layout='@system/modules/errors/themes/one/views/layout/main.php';
			}
			return [
				'error' => [
					'class' => 'YiiMan\YiiBasics\modules\errors\actions\ErrorHandler',
					'view' => $view,
					'layout' => $layout
				],
			];
		}
		
		
	}
