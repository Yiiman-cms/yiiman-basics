<?php
/**
 * Copyright (c) 2018-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: 8/12/2018
 * Time: 3:10 PM
 */

use YiiMan\YiiBasics\widgets\fontAwesomePicker\assets\FontAwesomeFontPickerAssets;

/**
 * @var $label       string
 * @var $name        string
 * @var $description string
 * @var $this        \yii\web\View
 * @var $view        \yii\web\View
 */
FontAwesomeFontPickerAssets::register($view);
$id = $name;

$js = <<<JS
	$('.picker-input').iconpicker(
	    {
	    placement: 'topLeftCorner'
	    }
	);

	$('.picker-input').on('iconpickerSelected', function(event){
	 
		$('.$name').html('<i class="fas '+event.iconpickerValue+'"></i>');
	});
JS;
$this->registerJs($js, $this::POS_END);
?>
<style>
    .input-group-addon.Menu\[icon\] {
        background: #0000001a;
        border-radius: 0 5px 5px 0;
        padding-left: 28px;
        padding-top: 8px;
        font-size: 18px;
    }

    .form-control.picker-data.picker-element.picker-input.iconpicker-element.iconpicker-input {
        border-radius: 5px 0 0 5px;
        text-align: left;
        direction: ltr !important;
        font-weight: 900;
    }
</style>
<div class="input-group picker-container">

    <span class="input-group-addon <?= $id ?>"><i class="fas fa-archive"></i></span>
    <input data-hide-on-select="true" name="<?= $name ?>" class="form-control picker-data picker-element picker-input"
           value="<?= $value ?>"
           type="text">
</div>


