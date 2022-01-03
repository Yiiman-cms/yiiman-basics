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
	 * Date: 30/04/2019
	 * Time: 03:57 PM
	 */
	
	namespace YiiMan\YiiBasics\lib;
	
	
	use Yii;
	use yii\base\Component;
	use const YII_DEBUG;
	
	class Develop extends Component {
		private $Assetversion;
		
		/**
		 * ورژن فایل هاس است را برمیگرداند.
		 * در صورتی که سیستم در حالت دیباگ باشد، ورژن را افزایش می دهد و در غیر این صورت ورژن ثابت را بازگردانی می کند.
		 */
		public function assetVersion() {
			if ( empty( $this->Assetversion ) ) {
				
				$version = 1;
				
				
				
				if ( !isset( Yii::$app->Options->assetVersion ) ) {
					
					Yii::$app->Options->set( 'assetVersion' , 1 );
				} else {
					if(YII_DEBUG){
						$version = (integer) Yii::$app->Options->assetVersion + 1;
						Yii::$app->Options->set( 'assetVersion' , $version );
					}else{
						$version = (integer) Yii::$app->Options->assetVersion;
					}
				}
				$this->Assetversion = $version;
				
				return $version;
			} else {
				return $this->Assetversion;
			}
		}
		
		/**
		 * فایل های است ها را دریافت می کند و ورژن آخرین تغییر را آخر آن می چسباند و سپس فایل را بازگردانی می کند
		 * @param $cssFiles
		 * @param $jsFiles
		 */
		public function changeAssetsVersion( &$cssFiles , &$jsFiles ) {
			foreach ( $cssFiles as $key => $css ) {
				$cssFiles[ $key ] = $css . '?ver=' . $this->assetVersion();
			}
			foreach ( $jsFiles as $key => $js ) {
				$jsFiles[ $key ] = $js . '?ver=' . $this->assetVersion();
			}
		}
		
	}
