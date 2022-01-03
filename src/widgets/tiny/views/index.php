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
	
	use YiiMan\YiiBasics\widgets\tiny\assets\TinyAssets;
	use yii\web\View;
	
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: 8/16/2018
	 * Time: 2:59 AM
	 */
	/**
	 * @var $model \yii\db\ActiveRecord
	 * @var $this  \yii\web\View
	 */
	
	TinyAssets::register( $this );
	
	$js = <<<JS
	$(document).ready(function() {
	tinymce.init({ selector:'#$id' });
	});
JS;
	$this->registerJs( $js , View::POS_END );



?>
<!--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>-->

<textarea style="margin-top: 20px;margin-bottom: 20px" name="<?= $name ?>" id="<?= $id ?>" cols="30" rows="10"><?= $value ?></textarea>
