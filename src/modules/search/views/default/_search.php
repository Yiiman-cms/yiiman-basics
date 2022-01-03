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
/* @var $model YiiMan\YiiBasics\modules\search\models\SearchSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="search-search">

    <?php $form = ActiveForm::begin([
        'action'  => ['index'],
        'method'  => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'query') ?>

    <?= $form->field($model, 'resultCount') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'result_types') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('search', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('search', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
