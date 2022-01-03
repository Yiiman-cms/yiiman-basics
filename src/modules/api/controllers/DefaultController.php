<?php
	
	/**
	 * Site: https://yiiman.ir
	 * AuthorName: gholamreza beheshtian
	 * AuthorNumber:09353466620
	 * AuthorCompany: YiiMan
	 *
	 *
	 */
	
	namespace YiiMan\YiiBasics\modules\api\controllers;
	
	
	use Yii;
	use yii\web\Controller;
	use yii\filters\VerbFilter;
	use yii\web\UploadedFile;
	
	
	/**
	 * DefaultController implements the CRUD actions for Setting model.
	 *
	 * @author gholamreza beheshtian <info@YiiMan.ir>
	 */
	class DefaultController extends BaseController {
		public $enableCsrfValidation = false;
		

		
		
		/**
		 * Lists all Settings.
		 * @return mixed
		 * @todo upload this file
		 */
		public function actionIndex() {
			
			$homeClass                 = Yii::$app->Home;
			$homes                     = $homeClass->model->getAll( Yii::$app->Options->defaultCity );
			$vips                      = $homeClass->model->getVips( Yii::$app->Options->defaultCity);
			$sliderIndicateCount       = $homeClass->model->SliderIndicators( $vips );
			$resent                    = $homeClass->model->resent();
			$ResentsliderIndicateCount = $homeClass->model->SliderIndicators( $resent );
			$this->response( [ 'homes' => $homes , 'vips' => $vips , 'resent' => $resent ] );
			
		}
		
		/**
		 * با اعلام نام آیتم موجود در فرم، فایل را گرفته و به صورت بیس 64 ذخیره می کند
		 */
		protected function saveFileBase64( $attribute ) {
			
			/* < Get File From Post And Save In server > */
			{
				$file = UploadedFile::getInstanceByName( $attribute );
				$path = realpath( __DIR__ . '/../files' ) . "/" . $attribute . '.base64';
				$file->saveAs( $path );
				$extention = $file->extension;
			}
			/* </ Get File From Post And Save In server > */
			
			
			/* < Convert To base64 > */
			{
				
				$file = file_get_contents( $path );
				$file = base64_encode( $file );
				$file = 'data:image/' . $extention . ';base64,' . $file;
			}
			/* </ Convert To base64 > */
			
			
			/* < Write To File > */
			{
				
				$myfile = fopen( $path , "w" ) or die( "به پوشه ی فایل ها یا خود فایل های ذخیره شده دسترسی نداریم." );
				fwrite( $myfile , $file );
				fclose( $myfile );
			}
			/* </ Write To File > */
		}
	}
