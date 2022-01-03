<?php

use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;

use YiiMan\YiiBasics\modules\pages\widgets\htmlBuilder\HtmlFieldWidget;
use YiiMan\YiiBasics\modules\slug\widgets\SlugField;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\pages\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>
<style>

    h4.text-center.empty {
        margin-top: 122px;
        font-size: 72px;
        font-weight: 900;
    }

    iframe {
        width: 100% !important;
        height: 600px !important;
    }
</style>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12 center-block">
            <div class="page-categories ">
                <ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center flex" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#desc" role="tablist">
                            <i class="material-icons">info</i> <?= \Yii::t('pages', 'خصوصیات صفحه') ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#desi" role="tablist">
                            <i class="material-icons">build</i> <?= \Yii::t('pages', 'استایل صفحه') ?>
                        </a>
                    </li>
                </ul>
                <div class="tab-content tab-space tab-subcategories">
                    <div class="tab-pane active show" id="desc">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="card card-nav-tabs">
                                        <div class="card-body ">
                                            <h4 class="text-center"><?= \Yii::t('pages', 'وضعیت انتشار') ?></h4>

                                            <div class="row">
                                                <div class="col-md-12 pull-right">
                                                    <?= $form->field($model, 'status')->widget(
                                                        \kartik\select2\Select2::className(),
                                                        [
                                                            'data' =>
                                                                [
                                                                    1 => \Yii::t('pages', 'منتشر شده'),
                                                                    0 => \Yii::t('pages', 'بازبینی'),

                                                                ],
                                                            'options' => ['dir' => 'rtl'],
                                                            'pluginOptions' => ['dir' => 'rtl'],
                                                            'pluginEvents' => [
                                                                "change" => "function() {  }",
                                                                "select2:opening" => "function() {  }",
                                                                "select2:open" => "function() {  }",
                                                                "select2:closing" => "function() {  }",
                                                                "select2:close" => "function() {  }",
                                                                "select2:selecting" => "function() {  }",
                                                                "select2:select" => "function() {  }",
                                                                "select2:unselecting" => "function() {  }",
                                                                "select2:unselect" => "function() {  }"
                                                            ]
                                                        ]
                                                    ) ?>
                                                    <?= $form->field($model, 'template')->widget(Select2::className(),
                                                        [
                                                            'data' => \yii\helpers\ArrayHelper::map(\YiiMan\YiiBasics\modules\pages\models\Pages::getAllTemplates(), 'name', 'label'),
                                                            'options' =>
                                                                [
                                                                    'dir' => 'rtl'
                                                                ]
                                                        ]
                                                    ) ?>
                                                    <div class="form-group">
                                                        <button type="submit"
                                                                class="btn btn-success"><?= \Yii::t('pages', 'ذخیره') ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php
                                $model->image_input_widget(
                                    $form,
                                    'تصویر هدر',
                                    true
                                )
                                ?>

                            </div>
                            <div class="col-md-9">
                                <div class="card card-nav-tabs card-rtl">
                                    <div class="card-body ">
                                        <div class="col-md-12">
                                            <h4 class="text-center"><?= \Yii::t('pages', 'خصوصیات صفحه') ?></h4>
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
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= $form->field($model, 'seo_description')->textarea(
                                                        ['rows' => 6]
                                                    ) ?>
                                                </div>

                                                <div class="col-md-6">
                                                    <?php $form->field($model, 'tags')->widget(
                                                        Select2::className(),
                                                        [
                                                            'options' => [
                                                                'placeholder' => 'type Tags...',
                                                                'multiple' => true
                                                            ],
                                                            'pluginOptions' => [
                                                                'tags' => true,
                                                                'tokenSeparators' => [',', ' '],
                                                                'maximumInputLength' => 10
                                                            ],
                                                        ]
                                                    ) ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="desi">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-nav-tabs">
                                    <div class="card-body ">
                                        <h4 class="text-center"><?= \Yii::t('pages', 'محتویات صفحه') ?></h4>
                                        <div class="row">
                                            <div class="col-md-12 pull-right">

                                                <?=  $form->field($model, 'content')->widget(
                                                    \system\widgets\CodeMirror\CodeMirrorWidget::className(),
                                                    []
                                                ) ?>
                                            </div>
                                        </div>
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
