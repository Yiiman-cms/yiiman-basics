<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$rules = Yii::$app->authManager->getRules();


$rulesNames = array_keys($rules);
$rulesDatas = array_merge(['' => Yii::t('rbac', '(not use)')], array_combine($rulesNames, $rulesNames));

?>

<div class="auth-item-form">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-nav-tabs">
                <div class="card-body ">
                    <h4 class="text-center"></h4>
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'ruleName')->dropDownList($rulesDatas) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'description')->textarea(['rows' => 1]) ?>
                                </div>
                            </div>
                            <?php if (!Yii::$app->request->isAjax) { ?>
                                <div class="form-group">
                                    <?= Html::submitButton(
                                        Yii::t('rbac', 'Save'),
                                        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
                                    ) ?>
                                </div>
                            <?php } ?>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
