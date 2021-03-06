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
/* @var $model YiiMan\YiiBasics\modules\menu\models\Menu */

$this->title = Yii::t('menu', 'بروزرسانی منو: '.$model->title, [
    'nameAttribute' => ''.$model->title,
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('menu', 'مدیریت منو'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url'   => [
        'view',
        'id' => $model->id
    ]
];
$this->params['breadcrumbs'][] = Yii::t('menu', 'ویرایش');
?>
<div class="menu-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
