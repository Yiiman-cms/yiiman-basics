<?php
	
	
	namespace YiiMan\YiiBasics\modules\pages\widgets\noviBuilder\assets;
	
	use Yii;
	use yii\web\AssetBundle;
	
	class Assets extends \YiiMan\YiiBasics\lib\AssetBundle {
		
		
		public $sourcePath = '@system/modules/pages/widgets/noviBuilder/assets/files';

		public $depends = [
			'yii\web\YiiAsset' ,
			'yii\bootstrap\BootstrapAsset' ,
		];
	}
