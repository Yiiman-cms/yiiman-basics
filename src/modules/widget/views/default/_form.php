<?php

use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\widget\models\Widget */
/* @var $form yii\widgets\ActiveForm */


?>
<style>
    #themeComponentsTitle {
        cursor: pointer;
    }

    .img-raised.rounded.img-fluid {
        cursor: pointer;
    }
</style>
<div class="widget-form">

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

        <div class="col-md-3">
            <div class="row">
                <div class="card card-nav-tabs" style="margin-top: 20px ">
                    <div class="card-body ">
                        <h4 class="text-center">ذخیره و انتشار</h4>
                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="card card-nav-tabs">
                    <div class="card-body ">
                        <h4 class="text-center">موقعیت ویجت</h4>
                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <?php
                                $disabled = \YiiMan\YiiBasics\modules\widget\models\Widget::disabledItemsSelect2();
                                if (!empty($model->shortCode)) {
                                    unset($disabled[$model->shortCode]);
                                }
                                ?>
                                <?= $form->field($model, 'shortCode')->widget(Select2::className(),
                                    [
                                        'data' => \YiiMan\YiiBasics\modules\widget\models\Widget::getLocations(),
                                        'options' =>
                                            [
                                                'options' => $disabled
                                            ]
                                    ])->hint('هر موقعیت فقط یک بار قابلیت ثبت ویجت را دارد و پس از پر شدن دیگر قابل انتخاب نیست، مگر آنکه از سیستم حذف شود') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-nav-tabs" style="margin-top: 20px ">
                <div class="card-body ">
                    <h4 class="text-center">مشخصات</h4>
                    <div class="row">
                        <div class="col-md-12 pull-right">

                            <div class="col-md-6"><?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>

                            <div class="col-md-12">
                                <?= $form->field($model, 'content')->widget(\YiiMan\YiiBasics\widgets\CodeMirror\CodeMirrorWidget::className()) ?>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
