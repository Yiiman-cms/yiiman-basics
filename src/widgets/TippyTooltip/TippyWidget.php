<?php
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: 03/22/2020
	 * Time: 23:47 PM
	 */
	
	namespace YiiMan\YiiBasics\widgets\TippyTooltip;
	
	
	use YiiMan\YiiBasics\widgets\TippyTooltip\assets\TippyAsset;
	use yii\base\Widget;
	
	class TippyWidget extends Widget {
		
		public function run() {
			$js = <<<JS
 			tippy('[data-toggle="tooltip"]');
JS;
			TippyAsset::register( $this->view );
			$this->view->registerJs( $js,$this->view::POS_END );
		}
		
		public static function attribute($title) {
			return 'data-toggle="tooltip" data-tippy-content="'.$title.'"';
		}
	}
