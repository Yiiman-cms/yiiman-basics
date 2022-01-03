<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

	/**
	 * Created by YiiMan.
	 * Programmer: gholamreza beheshtian
	 * Mobile:+989353466620 | +17272282283
	 *
	 * Site:https://yiiman.ir
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
