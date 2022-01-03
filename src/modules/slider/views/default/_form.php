<?php

use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\slider\models\Slider */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="card card-nav-tabs">
                    <div class="card-body ">
                        <h4 class="text-center">وضعیت
                            انتشار اسلاید</h4>

                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <?= $form->field($model, 'status')->widget(
                                    \kartik\select2\Select2::className(),
                                    [
                                        'data' =>
                                            [
                                                $model::STATUS_ACTIVE => 'منتشر شده',
                                                $model::STATUS_DE_ACTIVE => 'در حال بازبینی',

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
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $model->image_input_widget($form, 'تصویر اسلاید', true) ?>
        </div>
        <div class="col-md-9">
            <div class="card card-nav-tabs card-rtl">
                <div class="card-body ">
                    <div class="col-md-12">
                        <h4 class="text-center">مشخصات</h4>
                        <div class="row">
                            <div class="col-md-6"><?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>
                            <div class="col-md-6"><?= $form->field($model, 'link')->textInput() ?></div>
                            <div class="col-md-12"><?= $form->field($model, 'linkDescription')->textInput() ?></div>
                            <div class="col-md-12"><?= $form->field($model, 'title2')->textInput() ?></div>
                            <div class="col-md-6"><?= $form->field($model, 'index')->textInput() ?></div>
                            <div class="col-md-6"><?= $form->field($model, 'topMargin')->input('number') ?></div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

        <?php $form->field($model,'status')->widget(YiiMan\YiiBasics\modules\slider\widgets\ism\ISM_SliderWidget::className()) ?>

    <?php ActiveForm::end(); ?>

</div>
