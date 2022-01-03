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
/* @var $model YiiMan\YiiBasics\modules\ticket\models\TicketDepartmentUsers */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="ticket-department-users-form">

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
                        <h4 class="text-center"></h4>
                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <?= $form->field($model, 'uid')->widget(
                                    \kartik\select2\Select2::className(),
                                    [
                                        'data'          => \yii\helpers\ArrayHelper::map(
                                            \YiiMan\YiiBasics\modules\user\models\UserAdmin::find()->where(['language_parent' => null])->all(),
                                            'id',
                                            'title'
                                        ),
                                        'pluginOptions' => ['dir'         => 'rtl',
                                                            'placeholder' => 'لطفا انتخاب کنید'
                                        ]
                                    ]
                                ) ?>                                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card card-nav-tabs" style="margin-top: 20px ">
                    <div class="card-body ">
                        <h4 class="text-center"> نام دپارتمان</h4>
                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <?= $form->field($model, 'department')->widget(
                                    \kartik\select2\Select2::className(),
                                    [
                                        'data'          => \yii\helpers\ArrayHelper::map(
                                            \YiiMan\YiiBasics\modules\ticket\models\TicketDepartments::find()->where(['language_parent' => null])->all(),
                                            'id',
                                            'title'
                                        ),
                                        'pluginOptions' => ['dir'         => 'rtl',
                                                            'placeholder' => 'لطفا انتخاب کنید'
                                        ]
                                    ]
                                ) ?>                                        </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
