<?php

/**
 * Copyright (c) 2018.
 * Author: Tokapps Tm
 * Programmer: gholamreza beheshtian
 * mobile: 09353466620
 * WebSite:http://tokapps.ir
 *
 *
 */
namespace YiiMan\YiiBasics\widgets\materialFont;
/**
 * Class FileUploadWidget
 * @package YiiMan\YiiBasics\widgets\fileUpload
 * @property string $callBack javascript callBack function name if file successfully uploaded
 */
class MaterialFontWidget extends \yii\base\Widget {

	public $view;




	public function init() {
		parent::init(); // TODO: Change the autogenerated stub
		
		echo $this->render( 'index' . $this->view,
			[
				'class'=>$this
			]
		);
	}


}
