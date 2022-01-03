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
/* @var $model YiiMan\YiiBasics\modules\slug\models\SearchSlug */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slug-search">

    <?php $form = ActiveForm::begin([
        'action'  => ['index'],
        'method'  => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'table_name') ?>

    <?= $form->field($model, 'table_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('slug', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('slug', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
