<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
use YiiMan\Setting\module\models\DynamicModel\widgets\ImageField;
use YiiMan\YiiBasics\modules\slug\widgets\SlugField;
use YiiMan\YiiBasics\modules\user\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\blog\models\BlogCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-articles-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-nav-tabs">
                        <div class="card-body ">
                            <h4 class="text-center"><?= \Yii::t('blog', 'دسته ی مادر') ?></h4>
                            <div class="row">
                                <div class="col-md-12 pull-right">
                                    <?= $form->field($model, 'parent')
                                        ->widget(Select2::className(),
                                            [
                                                'data'    =>
                                                    ArrayHelper::map(\YiiMan\YiiBasics\modules\blog\models\BlogCategory::find()->all(),
                                                        'id', 'title'),
                                                'options' => ['placeholder' => \Yii::t('blog', 'انتخاب کنید')]
                                            ]
                                        ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $model->image_input_widget($form, \Yii::t('blog', 'تصویر شاخص'), true) ?>

        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-nav-tabs card-rtl">
                        <div class="card-body ">
                            <div class="col-md-12">
                                <h4 class="text-center"><?= \Yii::t('blog', 'اطلاعات') ?></h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'title')->textInput(
                                            ['maxlength' => true]
                                        ) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= SlugField::run($form, $model) ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
