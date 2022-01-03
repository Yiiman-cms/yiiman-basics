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
/* @var $model YiiMan\YiiBasics\modules\posttypes\models\SearchPosttypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posttypes-search">

    <?php $form = ActiveForm::begin([
        'action'  => ['index'],
        'method'  => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'language') ?>

    <?= $form->field($model, 'language_parent') ?>

    <?= $form->field($model, 'postType') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'content') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('posttypes', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('posttypes', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
