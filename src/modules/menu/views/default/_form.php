<?php


use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
use YiiMan\YiiBasics\modules\menu\models\Menu;
use YiiMan\YiiBasics\modules\pages\models\Pages;
use YiiMan\YiiBasics\modules\slug\widgets\SlugField;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\menu\models\Menu */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs($this->render('script/form.js'), $this::POS_END);
?>
<script>
    var Menutypes =<?= json_encode(\YiiMan\YiiBasics\modules\menu\models\Menu::getTypes()) ?>;
    var relatedUrl='<?= Yii::$app->urlManager->createUrl(['/menu/default/related-data']) ?>';
</script>
<style>
    #menu-url {
        direction: ltr;
        text-align: left;
    }
    .form-control.iconpicker-search {
        direction: ltr;
        text-align: left;
    }
</style>
<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="card card-nav-tabs">
                    <div class="card-body ">
                        <h4 class="text-center"><?= \Yii::t('menu', 'وضعیت انتشار') ?></h4>

                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <?= $form->field($model, 'status')->widget(
                                    \kartik\select2\Select2::className(),
                                    [
                                        'data' =>
                                            [
                                                1 => \Yii::t('menu', 'منتشر شده'),
                                                0 => \Yii::t('menu', 'بازبینی'),

                                            ],
                                        'options' => ['dir' => 'ltr'],
                                        'pluginOptions' => ['dir' => 'ltr'],
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
                                );

                                $model->relationField(
                                    $form,
                                    'parent_id',
                                    Menu::className(),
                                    '',
                                    '',
                                    \Yii::t('menu', 'منوی مادر'),
                                    false
                                )
                                ?>
                                <div class="form-group">
                                    <button type="submit" id="saveBtn"
                                            class="btn btn-success"><?= \Yii::t('menu', 'ذخیره') ?></button>
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
                        <h4 class="text-center"><?= \Yii::t('menu', 'خصوصیات') ?></h4>
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
                        <div class="row" style="margin-top:20px">

                            <div class="col-md-6">
                                <?= $form->field($model, 'type')->widget(
                                    Select2::className(),
                                    [
                                        'data' =>
                                            ArrayHelper::merge(
                                                [
                                                    0 => \Yii::t('menu', 'یکی را انتخاب کنید'),
                                                    'url' => \Yii::t('menu', 'لینک'),
                                                ],
                                                ArrayHelper::map(Menu::getTypes(), 'name', 'label'))
                                    ]
                                ) ?>
                                <?= $form->field($model, 'index')->textInput(
                                    ['type' => 'number']
                                ) ?>
                                <?php $form->field($model, 'icon')->widget(\YiiMan\YiiBasics\widgets\fontAwesomePicker\FontAwesomeFontPickerWidget::className()) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'related_id')->widget(
                                    Select2::className(),
                                    [
                                        'data' => []
                                    ]
                                ) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'url')->textInput(
                                    ['maxlength' => true]
                                ) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'location')->widget(
                                    Select2::className(),
                                    [
                                        'data' =>
                                            Menu::getLocations()
                                    ]
                                ) ?>
                            </div>



                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
