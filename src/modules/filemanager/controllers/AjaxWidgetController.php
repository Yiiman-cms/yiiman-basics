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
	 * Date: 12/30/2018
	 * Time: 9:54 AM
	 */
	
	namespace YiiMan\YiiBasics\modules\filemanager\controllers;
	
	
	use function ob_clean;
	use function ob_get_clean;
	use function ob_implicit_flush;
	use function ob_start;
	use function realpath;
	use YiiMan\YiiBasics\lib\Controller;
	use Yii;
	use yii\web\Response;
	
	class AjaxWidgetController extends Controller {
		public function actionList($path=''){
			Yii::$app->response->format=Response::FORMAT_JSON;
			ob_start();
			ob_implicit_flush(false);
			include realpath( __DIR__.'/../components/widget/index.php');
			$out=ob_get_clean();
			return $out;
			
		}
	}
