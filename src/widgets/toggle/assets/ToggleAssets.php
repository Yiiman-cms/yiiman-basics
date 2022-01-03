<?php
	
	namespace YiiMan\YiiBasics\widgets\toggle\assets;
	
	use yii\web\AssetBundle;
	
	class ToggleAssets extends AssetBundle {
		public $sourcePath = '@system/widgets/toggle/assets/files';
		public $js =
			[
				'bootstrap2-toggle.min.js'
			];
		public $css =
			[
				'bootstrap2-toggle.min.css',
			];
		
		public $depends = [
			'yii\web\YiiAsset' ,
			'yii\bootstrap\BootstrapAsset' ,
		];
	}
