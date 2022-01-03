<?php
	
	/**
	 * Site: https://yiiman.ir
	 * AuthorName: gholamreza beheshtian
	 * AuthorNumber:09353466620
	 * AuthorCompany: YiiMan
	 *
	 *
	 */
	
	namespace YiiMan\YiiBasics\modules\rss\controllers;
	use YiiMan\Setting\module\components\Options;
	use Yii;
	use yii\di\Container;
	use yii\web\BadRequestHttpException;
	use yii\web\Controller;
	use yii\filters\VerbFilter;
	use yii\web\UploadedFile;
	
	class DefaultController extends Controller {
		public $enableCsrfValidation = false;

		/**
		 * Lists all Settings.
		 * @return mixed
		 * @todo upload this file
		 */
		public function actionIndex() {
		
			if (class_exists( Options::className())){
				throw new BadRequestHttpException('لطفا ابتدا ماژول تنظیمات را نصب نمایید، سپس از ماژول RSS استفاده فرمایید.');
			}
		}

	}
