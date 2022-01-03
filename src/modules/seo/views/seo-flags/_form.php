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
/* @var $model YiiMan\YiiBasics\modules\seo\models\SeoFlags */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seo-flags-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6"><?= $form->field($model, 'flag')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-6"><?= $form->field($model, 'content')->widget(
            Select2::className(),
            [
                'data' => \yii\helpers\ArrayHelper::map(
                    \YiiMan\YiiBasics\modules\seo\models\SeoFlagContents::find()->all(),
                    'id',
                    'title'
                )
            ]
        ) ?></div>

    <?= Html::submitButton('ثبت') ?>
    <?php ActiveForm::end(); ?>

</div>
