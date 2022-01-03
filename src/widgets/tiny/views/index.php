<?php
/**
 * Copyright (c) 2018-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\widgets\tiny\assets\TinyAssets;
use yii\web\View;

/**
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: 8/16/2018
 * Time: 2:59 AM
 */
/**
 * @var $model \yii\db\ActiveRecord
 * @var $this  \yii\web\View
 */

TinyAssets::register($this);

$js = <<<JS
	$(document).ready(function() {
	tinymce.init({ selector:'#$id' });
	});
JS;
$this->registerJs($js, View::POS_END);


?>
<!--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>-->

<textarea style="margin-top: 20px;margin-bottom: 20px" name="<?= $name ?>" id="<?= $id ?>" cols="30"
          rows="10"><?= $value ?></textarea>
