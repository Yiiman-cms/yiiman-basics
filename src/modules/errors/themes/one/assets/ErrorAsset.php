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
	 * Date: 12/14/2018
	 * Time: 8:14 PM
	 */
	namespace YiiMan\YiiBasics\modules\errors\themes\one\assets;
	
	use yii\web\AssetBundle;
	use yii\web\JqueryAsset;
	
	
	class ErrorAsset extends AssetBundle {
		public $sourcePath='@system/modules/errors/themes/one/assets/files';
		public $css = [ 'style.css','fonts/font-face.css' ];
		public $js = [ 'main.css' ];
		
		
		public $depends = [
			'yii\web\JqueryAsset',
			'yii\bootstrap\BootstrapAsset',
		];
	}
