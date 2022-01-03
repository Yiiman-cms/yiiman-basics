<?php
	/**
	 * Created by YiiMan TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:https://yiiman.ir
	 * Date: ۰۲/۲۴/۲۰۲۰
	 * Time: ۱۱:۵۳ قبل‌ازظهر
	 */
	
	namespace YiiMan\YiiBasics\modules\pages\widgets\htmlBuilder;
	
	
	use kartik\base\InputWidget;
	
	class HtmlFieldWidget extends InputWidget {
		
		public function run() {
			parent::run();

			return $this->render(
				'htmlField' ,
				[
					'value' => $this->value ,
					'id'    => $this->id ,
					'model' => $this->model
				]
			);
		}
	}
