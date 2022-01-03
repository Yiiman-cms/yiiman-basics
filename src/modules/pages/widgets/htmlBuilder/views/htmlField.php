<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @var $this  \YiiMan\YiiBasics\lib\View
 * @var $model \YiiMan\YiiBasics\modules\pages\models\Pages
 */

use YiiMan\YiiBasics\modules\pages\widgets\htmlBuilder\assets\Assets;


$this->registerJs($this->render('scripts/app.js'));

?>
<style>
    #FileFrame {
        width: 100%;
        height: 100vh;
        border: none;
    }
</style>
<div class="row">
    <p class="col-md-12">
    <p class="text-center">
        Edit Page Content And Press <i class="la la-save"></i> Key To Save Page Content
    </p>
</div>

<div class="row">
    <div class="col-md-12" id="htmlContainer">
        <iframe id="FileFrame"
                src="<?= Yii::$app->Options->BackendUrl.'/pages/widget?id='.$model->id.'&v='.uniqid() ?>"></iframe>
    </div>
</div>
