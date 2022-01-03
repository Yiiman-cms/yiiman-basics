<?php

use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\product\models\Product */
/* @var $form yii\widgets\ActiveForm */

$redactorOptions =
    [
        'plugins' =>
            [
                'imagemanager',
                'table',
                'fullscreen',
                'fontfamily',
                'fontcolor',
                'fontsize',
                'limiter'
            ],
        'autosave' => false, // false or url
        'autosaveName' => false,
        'autosaveInterval' => 60, // seconds
        'autosaveOnChange' => false,
        'autosaveFields' => false,

        'direction' => \YiiMan\YiiBasics\lib\i18n\Layout::run(),
        'linkNofollow' => true,
        'dragFileUpload' => false,
        'buttons' =>
            [
                'formatting',
                'bold',
                'unorderedlist',
                'orderedlist',
                'outdent',
                'indent',
                'image',
                'alignment',
                'horizontalrule'
            ],
        'deniedTags' =>
            [
                'script',
                'style',

                'php',
            ],
        'removeEmpty' => ['p', 'img', 'a', 'h1', 'h2', 'span', 'i'], // or false;
    ];
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="card card-nav-tabs">
                    <div class="card-body ">
                        <h4 class="text-center">وضعیت
                            انتشار محصول</h4>

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
            <?php $model->image_input_widget($form, 'درج تصویر');
            ?>            </div>
        <div class="col-md-9">
            <div class="card card-nav-tabs card-rtl">
                <div class="card-body ">
                    <div class="col-md-12">
                        <h4 class="text-center">مشخصات</h4>
                        <div class="row">
                            <div class="col-md-6"><?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>
                            <div class="col-md-6"><?= $form->field($model, 'sub_title')->textInput(['maxlength' => true]) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?= \YiiMan\YiiBasics\modules\slug\widgets\SlugField::run($form,$model) ?>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4"><?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?></div>

                            <div class="col-md-4"><?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?></div>

                            <div class="col-md-4"><?= $form->field($model, 'weight')->textInput() ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?= \system\widgets\redactor\widgets\Redactor::widget(
                                    [
                                        'name' => 'description',
                                        'fileUpload' => false,
                                        'value' => $model->description,
                                        'clientOptions' => $redactorOptions

                                    ]
                                ) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><?= $form->field($model, 'discount')->textInput() ?></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
