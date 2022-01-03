<?php

use YiiMan\YiiBasics\modules\rbac\models\ModuleRbacAuthAssignment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** Get all roles */
/**
 * @var $this \YiiMan\YiiBasics\lib\View
 * @var $model ModuleRbacAuthAssignment
 * @var $roles []
 * @var $users []
 */
$authManager = Yii::$app->authManager;
$this->title = Yii::t('rbac', 'انتساب نقش به کاربر');

$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac', 'انتساب نقش به کاربران'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin();
?>
<div class="user-assignment-form">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-nav-tabs">
                <div class="card-body ">
                    <h4 class="text-center"></h4>
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="col-md-6">
                                <?= $form->field($model, 'item_name')->dropDownList($roles) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'users')->widget(
                                    \kartik\select2\Select2::className(),
                                    [
                                        'data' => $users,
                                        'pluginOptions' =>
                                            [
                                                'dir' => 'rtl',
                                                'multiple' => true
                                            ]
                                    ]
                                ) ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if (!Yii::$app->request->isAjax) { ?>
                                        <div class="form-group">
                                            <?= Html::submitButton(
                                                Yii::t('rbac', 'Save'),
                                                ['class' => 'btn btn-success']
                                            ) ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

