<?php
	
	namespace YiiMan\YiiBasics\widgets\notFound;
	
	use yii\base\Widget;
	
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: 01/05/2019
	 * Time: 07:00 PM
	 */
	class NotFoundWidget extends Widget {
		public $text;
		public $withRowColumn=true;
		
		public function run() {
			
			return $this->render(
				'index' ,
				[
					'text'     => $this->text ,
					'withRowColumn'     => $this->withRowColumn ,
				]
			);
		}
	}
