<?php
	
	namespace YiiMan\YiiBasics\widgets\summernote;
	
	use yii\web\AssetBundle;
	
	class SummernoteAssets extends \YiiMan\YiiBasics\lib\AssetBundle {
		public $sourcePath = '@system/widgets/summernote/files';
		public $js =
			[
				'summernote.min.js'
			];
		public $css =
			[
				'summernote.min.css',
			];
		
		public $depends = [
			'yii\web\YiiAsset' ,
			'yii\bootstrap\BootstrapAsset' ,
		];
	}
