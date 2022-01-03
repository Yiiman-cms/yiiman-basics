<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\widget\models\SearchWidget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widget-search">

    <?php $form = ActiveForm::begin([
        'action'  => ['index'],
        'method'  => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'shortCode') ?>

    <?= $form->field($model, 'language') ?>

    <?= $form->field($model, 'language_parent') ?>

    <?php // echo $form->field($model, 'title') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('widget', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('widget', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
