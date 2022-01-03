<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

	/**
	 * Created by YiiMan.
	 * Programmer: gholamreza beheshtian
	 * Mobile:+989353466620 | +17272282283
	 *
	 * Site:https://yiiman.ir
	 * Date: 12/29/2018
	 * Time: 10:32 AM
	 */
	
	use yii\helpers\Html;

?>
<div>
	<adm-dtp ng-model='date<?= $cls->id ?>' full-data='date_details'
	         options='{calType: "jalali", format: "YYYY/MM/DD", default: 1450197600000,dtpType:"date"}'>
		<!-- fully access to 'date' and 'date_details' parameters -->
		
		<!-- input is optional too, but must use in this format -->
		<?php
			if ( $hasModel ) {
				echo Html::activeTextInput(
					$cls->model ,
					$cls->attribute ,
					[
						'class'     => 'form-control' ,
						'ng-model'  => 'date' ,
						'dtp-input' => 'dtp-input' ,
						'value'     => $cls->value,
						'placeholder'=> $cls->value,
					]
				);
			} else {
				echo Html::textInput(
					$cls->model ,
					$cls->attribute ,
					[
						'class'     => 'form-control' ,
						'ng-model'  => 'date' ,
						'dtp-input' => 'dtp-input' ,
						'value'     => $cls->value,
						'placeholder'=> $cls->value,
					]
				);
			}
		?>
	
	</adm-dtp>
</div>
