<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\hint\models\Hint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hint-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6"><?= $form->field($model, 'date')->textInput() ?></div>

    <div class="col-md-6"><?= $form->field($model, 'count')->textInput() ?></div>

    <div class="col-md-6"><?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?></div>


    <?php ActiveForm::end(); ?>

</div>
