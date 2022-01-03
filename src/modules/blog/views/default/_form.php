<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
use YiiMan\YiiBasics\modules\setting\widgets\ImageField;
use YiiMan\YiiBasics\modules\slug\widgets\SlugField;
use YiiMan\YiiBasics\modules\user\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\blog\models\BlogArticles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-articles-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="card card-nav-tabs">
                    <div class="card-body ">
                        <h4 class="text-center"><?= \Yii::t('blog', 'وضعیت انتشار') ?></h4>

                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <?php
                                echo $form->field($model, 'status')->widget(
                                    \kartik\select2\Select2::className(),
                                    [
                                        'data'         =>
                                            [
                                                1 => 'منتشر شده',
                                                0 => 'بازبینی',

                                            ],
                                        'pluginEvents' => [
                                            "change"              => "function() {  }",
                                            "select2:opening"     => "function() {  }",
                                            "select2:open"        => "function() {  }",
                                            "select2:closing"     => "function() {  }",
                                            "select2:close"       => "function() {  }",
                                            "select2:selecting"   => "function() {  }",
                                            "select2:select"      => "function() {  }",
                                            "select2:unselecting" => "function() {  }",
                                            "select2:unselect"    => "function() {  }"
                                        ]
                                    ]
                                );
                                echo $form->field($model, 'author')->widget(
                                    Select2::className(),
                                    [
                                        'data' => ArrayHelper::map(\YiiMan\YiiBasics\modules\useradmin\models\User::find()->all(),
                                            'id', 'nickName')
                                    ]
                                ) ?>
                                <div class="form-group">
                                    <button type="submit"
                                            class="btn btn-success"><?= \Yii::t('blog', 'ذخیره') ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 20px">
                <div class="card card-nav-tabs">
                    <div class="card-body ">
                        <h4 class="text-center"></h4>
                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <?= $model->relationFieldTreeCheckBox(
                                    $form,
                                    'category',
                                    \YiiMan\YiiBasics\modules\blog\models\BlogCategory::className(),
                                    \YiiMan\YiiBasics\modules\blog\models\BlogArticleFkCategory::className(),
                                    ['article' => 'category'],
                                    'دسته بندی ها',
                                    true
                                ) ?>
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

                                    <div class="col-md-12">
                                        <?= $form->field($model, 'content')->widget(
                                            \YiiMan\YiiBasics\widgets\floara\FroalaEditorWidget::className(),
                                            []
                                        ) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-nav-tabs">
                        <div class="card-body ">
                            <h4 class="text-center"><?= \Yii::t('blog', 'اطلاعات مربوط به موتورهای جست و جو') ?></h4>
                            <div class="row">
                                <div class="col-md-6 pull-right">
                                    <?= $form->field($model, 'tags')->widget(
                                        Select2::className(),
                                        [
                                            'options'       =>
                                                [
                                                    'placeholder' => \Yii::t('blog', 'برچسب ها را تایپ کنید...'),
                                                    'multiple'    => true,
                                                    'dir'         => 'rtl'
                                                ],
                                            'pluginOptions' =>
                                                [
                                                    'tags'               => true,
                                                    'tokenSeparators'    => [
                                                        ',',
                                                        ' '
                                                    ],
                                                    'maximumInputLength' => 10
                                                ],
                                        ]
                                    ) ?>
                                </div>
                                <div class="col-md-6 pull-right">
                                    <?= $form->field($model, 'seo_description')->textarea() ?>
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
