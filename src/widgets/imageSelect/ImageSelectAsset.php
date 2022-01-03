<?php
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: ۱۷/۰۴/۲۰۲۰
	 * Time: ۰۳:۴۹ قبل‌ازظهر
	 */
	
	namespace YiiMan\YiiBasics\widgets\imageSelect;
	
	
	use YiiMan\YiiBasics\lib\AssetBundle;
	
	class ImageSelectAsset extends AssetBundle {
		public $sourcePath = '@system/widgets/imageSelect/file';
		public $js =
			[
				'jquery.imgcheckbox.js'
			];
		
		public $depends = [
			'yii\web\YiiAsset' ,
			'yii\bootstrap\BootstrapAsset' ,
		];
	}
