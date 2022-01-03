<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

	/**
	 * Created by YiiMan TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:+989353466620 | +17272282283
	 *
	 * Site:https://yiiman.ir
	 * Date: 10/19/2018
	 * Time: 7:00 PM
	 */
	
	namespace YiiMan\YiiBasics\modules\api\controllers;
	
	
	use function ob_end_flush;
	use function ob_flush;
	use function ob_start;
	use Yii;
	use yii\helpers\Json;
	use yii\rest\Controller;
	use yii\web\Response;
	
	class BaseController extends Controller {
		public function response($data){
			Yii::$app->response->format=Response::FORMAT_JSON;
			ob_start();
			echo Json::encode( $data);
//			ob_flush();
//			ob_end_flush();
		}
	}
