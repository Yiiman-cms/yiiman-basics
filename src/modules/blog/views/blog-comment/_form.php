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
/* @var $model YiiMan\YiiBasics\modules\blog\models\BlogComment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-comment-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="card card-nav-tabs">
                    <div class="card-body ">
                        <h4 class="text-center"><?= \Yii::t('site', 'وضعیت انتشار') ?></h4>

                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <?= $form->field($model, 'status')->widget(
                                    \kartik\select2\Select2::className(),
                                    [
                                        'data'          =>
                                            [
                                                \YiiMan\YiiBasics\modules\blog\models\BlogComment::STATUS_ACTIVE    => \Yii::t('site',
                                                    'منتشر شده'),
                                                \YiiMan\YiiBasics\modules\blog\models\BlogComment::STATUS_WAITING   => \Yii::t('site',
                                                    'در حال انتظار'),
                                                \YiiMan\YiiBasics\modules\blog\models\BlogComment::STATUS_DE_ACTIVE => \Yii::t('site',
                                                    'جفنگ')
                                            ],
                                        'options'       => ['dir' => 'rtl'],
                                        'pluginOptions' => ['dir' => 'rtl'],
                                        'pluginEvents'  => [
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
                                ) ?>
                                <div class="form-group">
                                    <button type="submit"
                                            class="btn btn-success"><?= \Yii::t('site', 'ذخیره') ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-nav-tabs card-rtl">
                <div class="card-body ">
                    <div class="col-md-12">
                        <h4 class="text-center"><?= \Yii::t('site', 'خصوصیات') ?></h4>
                        <div class="row">
                            <div class="col-md-4"><?= $form->field($model,
                                    'name')->textInput(['maxlength' => true]) ?></div>

                            <div class="col-md-4"><?= $form->field($model,
                                    'email')->textInput(['maxlength' => true]) ?></div>

                            <div class="col-md-4"><?= $form->field($model,
                                    'website')->textInput(['maxlength' => true]) ?></div>

                            <div class="col-md-12"><?= $form->field($model,
                                    'message')->textarea(['maxlength' => true]) ?></div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
