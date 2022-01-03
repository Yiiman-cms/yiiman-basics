<?php
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: 12/29/2018
	 * Time: 10:32 AM
	 */
	
	/**
	 * @var $hasModel
	 * @var $cls \yii\widgets\InputWidget
	 */
	
	use yii\helpers\Html;

?>
<div>
	
	<!-- input is optional too, but must use in this format -->
	<?php
		if ( $hasModel ) {
			echo Html::activeTextInput(
				$cls->model ,
				$cls->attribute ,
				[
					'class'       => 'form-control' ,
					'value'       => $cls->value ,
					'placeholder' => $cls->value ,
				]
			);
		} else {
			echo Html::textInput(
				$cls->model ,
				$cls->attribute ,
				[
					'class'       => 'form-control' ,
					'value'       => $cls->value ,
					'placeholder' => $cls->value ,
				]
			);
		}
	?>
</div>
