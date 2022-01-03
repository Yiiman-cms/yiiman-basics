<?php

use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\product\models\ProductCategory */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="product-category-form">

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
            <div class="row">
                <div class="card card-nav-tabs" style="margin-top: 20px ">
                    <div class="card-body ">
                        <h4 class="text-center"> Title</h4>
                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <?= $form->field($model, 'parent')->widget(
                                    \kartik\select2\Select2::className(),
                                    [
                                        'data' => \yii\helpers\ArrayHelper::map(
                                            \YiiMan\YiiBasics\modules\product\models\ProductCategory::find()->all(),
                                            'id',
                                            'title'
                                        ),
                                        'pluginOptions' => ['dir' => 'rtl', 'placeholder' => 'لطفا انتخاب کنید']
                                    ]
                                ) ?>
                            </div>
                        </div>
                        <?= $model->image_input_widget($form, 'تصاویر', true) ?>
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
