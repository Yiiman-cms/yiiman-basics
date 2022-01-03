<?php
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: 03/22/2020
	 * Time: 17:55 PM
	 */
	
	namespace YiiMan\YiiBasics\widgets\mobileInput;
	
	use kartik\base\InputWidget;
	use function str_replace;
	
	class MobileInputWidget extends InputWidget {
		public function run() {
			parent::run(); // TODO: Change the autogenerated stub
			$countryName = str_replace( '[' . $this->attribute . ']' , '[country]' , $this->name );
			
			return $this->render(
				'input' ,
				[
					'name'    => $this->name ,
					'id'      => $this->id ,
					'country' => $countryName ,
					'value'   => $this->value
				]
			);
		}
	}
