<?php
/**
 * @var $this \YiiMan\YiiBasics\lib\View
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'ایجاد نقش';
$rules = Yii::$app->authManager->getRules();
$rulesNames = array_keys($rules);
$rulesDatas = array_merge(['' => Yii::t('rbac', '(not use)')], array_combine($rulesNames, $rulesNames));

$authManager = Yii::$app->authManager;
$permissions = $authManager->getPermissions();
$p=$permissions;
$permissions = \yii\helpers\ArrayHelper::index($permissions, null, 'module_en');

$this->registerJs($this->render('script.js'),$this::POS_END);
$form = ActiveForm::begin();
?>
<style>
    .text-center.selectheader {
        user-select: none;
        cursor: pointer;
    }
</style>

<div class="auth-item-form">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-nav-tabs">
                <div class="card-body ">
                    <h4 class="text-center">مشخصات نقش</h4>
                    <div class="row">
                        <div class="col-md-12 pull-right">

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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:20px;margin-bottom:20px">
        <div class="col-md-12">
            <div class="card card-nav-tabs">
                <div class="card-body ">
                    <h3 class="text-center">مجوز ها</h3>
                </div>
            </div>
        </div>
    </div>
    <?php


    foreach ($permissions as $module_name => $array) {
        /**
         * @var $model \YiiMan\YiiBasics\modules\rbac\models\Permission
         */
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-12">
                        <div class="card card-nav-tabs" style="padding: 0;">
                            <div class="card-body " style="padding: 0;
margin: auto;">
                                <h3 class="text-center selectheader" for="sall<?= $module_name ?>" style="margin: auto;
padding: 0;"><?= 'مجوز های بخش ' . (empty($array[0]->module_fa) ? $array[0]->module_en : $array[0]->module_fa) ?></h3>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <td style="width:1px">
                                            <input type="checkbox" class="selectAll"  id="sall<?= $module_name ?>">
                                        </td>
                                        <td style="width:1px">
                                            <b><?= Yii::t('rbac', 'نام دسترسی') ?></b></td>
                                        <td><b><?= Yii::t('rbac', 'توضیحات دسترسی') ?></b></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    foreach ($array as $key => $m) {
                                        ?>
                                        <tr>
                                            <td>
                                                <input <?= in_array(
                                                    $m->name,
                                                    $p
                                                ) ? "checked" : "" ?>
                                                        type="checkbox" class="selectOnce" name="ModuleRbacAuthItem[permissions][]"
                                                        value="<?= $m->name ?>"  <?php
                                                            if (!empty($model->permissions[$m->name])){
                                                                echo 'checked';
                                                            }
                                                        ?>>
                                            </td>
                                            <td><?= $m->name ?></td>
                                            <td><?= $m->description ?></td>
                                        </tr>
                                        <?php


                                    }
                                    ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<?php ActiveForm::end(); ?>