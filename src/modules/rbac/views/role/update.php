<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \YiiMan\YiiBasics\modules\rbac\models\ModuleRbacAuthItem */
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('rbac', 'نقش ها'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
