<?php

use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\form\models\Form */
/* @var $form yii\widgets\ActiveForm */


?>
<?php
if (\YiiMan\YiiBasics\lib\i18n\Layout::run()=='rtl'){
    ?>
    <style>
        .form-wrap.form-builder .frmb-control li {
            cursor: move;
            list-style: none;
            text-align: right;
            white-space: nowrap;
        }
        .form-wrap.form-builder .frmb .form-elements .false-label:first-child, .form-wrap.form-builder .frmb .form-elements label:first-child {
            float: right;
        }
        pre code {
            padding: 0;
            font-size: inherit;
            color: inherit;
            white-space: pre-wrap;
            background-color: transparent;
            border-radius: 0;
            direction: ltr;
            text-align: left;
            float: left;
        }
        .form-wrap.form-builder .frmb li {
            margin-bottom: 43px !important;
        }
        .form-wrap.form-builder .frmb .field-actions {
            position: absolute;
            top: -5px;
            left: 0;
            opacity: 0;
            right: auto;
        }
    </style>
<?php
}
?>
<div class="form-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <?php if (Yii::$app->controller->action->id == 'update') {
            ?>
            <div class="viewLanguagebox">
                زبان های موجود:
                <?= (new \YiiMan\YiiBasics\lib\i18n\LanguageColumn())->renderDataCell($model, 0, 0) ?>
            </div>

        <?php }
        ?>

        <div class="col-md-12">
            <div class="row">
                <div class="card card-nav-tabs" style="margin-top: 20px ">
                    <div class="card-body ">
                        <h4 class="text-center"><?= \Yii::t('site','ذخیره و انتشار') ?></h4>
                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><?= \Yii::t('site','ذخیره') ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-nav-tabs" style="margin-top: 20px ">
                <div class="card-body ">
                    <h4 class="text-center"><?= \Yii::t('site','مشخصات') ?></h4>
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <div class="col-md-12"><?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>

                            <div class="col-md-12"><?= $form->field($model, 'details')->widget(\YiiMan\YiiBasics\modules\form\widgets\FormGeneratorWidget::className()) ?></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
