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
	
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: 8/16/2018
	 * Time: 2:57 AM
	 */
	
	namespace YiiMan\YiiBasics\widgets\MarkDownTelegramEditor;
	
	
	use yii\base\Widget;
	use yii\widgets\InputWidget;
	
	class MarkDownTelegramEditorWidget extends InputWidget {
		
		public $value;
		public $is_in_ajax_modal=false;
		public function run() {
			
			
			if ( empty( $this->value ) ) {
				if ( ! empty( $this->model->{$this->attribute} ) ) {
					$this->value = $this->model->{$this->attribute};
				} else {
					$this->value = '';
				}
			}
			
			
			echo $this->render(
				'index' ,
				[
					'model'     => $this->model ,
					'id'        => $this->id ,
					'name'      => $this->name ,
					'value'     => $this->value ,
					'cls'       => $this ,
					'hashModel' => $this->hasModel(),
					'is_in_ajax_modal' => $this->is_in_ajax_modal,
				]
			);
		}
	}
