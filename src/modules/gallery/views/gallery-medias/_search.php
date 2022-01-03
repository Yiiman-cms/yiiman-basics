<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\gallery\models\SearchGalleryMedias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-medias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'table') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'table_id') ?>

    <?php // echo $form->field($model, 'file_name') ?>

    <?php // echo $form->field($model, 'file_size') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'language_parent') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('gallery', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('gallery', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
