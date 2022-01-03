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
/* @var $model YiiMan\YiiBasics\modules\ticket\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
echo \YiiMan\YiiBasics\widgets\TippyTooltip\TippyWidget::widget();
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <div class="row">
        <div class="col-md-12">
            <div class="card card-nav-tabs card-rtl">
                <div class="card-body ">
                    <div class="col-md-12">
                        <h4 class="text-center">مشخصات</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <?php ?>
                                <?= $form->field($model,
                                    'subject')->textInput(Yii::$app->controller->action->id == 'create' ? [] : ['disabled' => 'disabled']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'department')->widget(Select2::className(),
                                    [
                                        'data'    => \yii\helpers\ArrayHelper::map(\YiiMan\YiiBasics\modules\ticket\models\TicketDepartments::find()->all(),
                                            'id', 'title'),
                                        'options' => Yii::$app->controller->action->id == 'create' ? [] : ['disabled' => 'disabled']
                                    ]
                                ) ?>
                            </div>
                        </div>
                        <?php
                        if (empty($model->id)) {
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'uid')->widget(Select2::className(),
                                        [
                                            'data'    => \yii\helpers\ArrayHelper::map(\YiiMan\YiiBasics\modules\user\models\User::find()->all(),
                                                'id', 'username'),
                                            'options' =>
                                                [
                                                    'dir'         => 'rtl',
                                                    'placeholder' => 'کاربر را انتخاب کنید',
                                                    'allowClear'  => true
                                                ]
                                        ]
                                    ) ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?= \YiiMan\YiiBasics\modules\ticket\widgets\MessengerWidget::widget(['model' => $model]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
