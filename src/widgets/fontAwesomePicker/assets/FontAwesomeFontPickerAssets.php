<?php
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: 8/12/2018
	 * Time: 11:49 AM
	 */
	
	namespace YiiMan\YiiBasics\widgets\fontAwesomePicker\assets;
	
	use YiiMan\YiiBasics\widgets\multiRowInput\assets\FontAwesomeAsset;
    use yii\web\AssetBundle;
	
	class FontAwesomeFontPickerAssets extends AssetBundle {
		public $sourcePath = '@system/widgets/fontAwesomePicker/assets/files';
		public $js =
			[
				'fontawesome-iconpicker.min.js'
			];
		public $css =
			[
				'fontawesome-iconpicker.min.css'
			];
		
		public $depends = [
			'yii\web\YiiAsset' ,
			'yii\bootstrap\BootstrapAsset' ,
            'YiiMan\YiiBasics\widgets\multiRowInput\assets\FontAwesomeAsset'
		];
	}
