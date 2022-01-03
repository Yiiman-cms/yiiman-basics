<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\filemanager\widget;
	
	use YiiMan\YiiBasics\modules\filemanager\assets\FileSelectorAsset;
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
	class FileSelectorWidget extends InputWidget {
		public $multiple = false;
		
		
		public function run() {
			
			
			parent::run(); // TODO: Change the autogenerated stub
			FileSelectorAsset::register( $this->view );
			echo $this->render(
				'@system/modules/filemanager/widget/views/widget.php' ,
				[
					'id'        => $this->id ,
					'name'      => $this->name ,
					'label'     => $this->model->getAttributeLabel(
						$this->attribute
					) ,
					'model'     => $this->model ,
					'attribute' => $this->attribute ,
					'value'     => $this->value ,

				]
			);
		}
	}
