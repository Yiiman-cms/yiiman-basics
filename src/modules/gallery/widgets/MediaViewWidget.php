<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\gallery\widgets;
	
	use YiiMan\YiiBasics\modules\filemanager\assets\FileSelectorAsset;
	use yii\base\Widget;
	use yii\widgets\InputWidget;
	
	/**
	 * Created by YiiMan TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:+989353466620 | +17272282283
	 *
	 * Site:https://yiiman.ir
	 * Date: 12/30/2018
	 * Time: 4:05 AM
	 */
	class MediaViewWidget extends Widget {
		public $model;
		public $attribute;
		public $count;
		
		public function run() {
			parent::run(); // TODO: Change the autogenerated stub
//			FileSelectorAsset::register( $this->view );
			echo $this->render(
				'@system/modules/gallery/widgets/views/widgetView.php' ,
				[
					'model'     => $this->model ,
					'attribute' => $this->attribute ,
					'id'        => $this->attribute ,
					'count'     => $this->count
				]
			);
		}
	}
