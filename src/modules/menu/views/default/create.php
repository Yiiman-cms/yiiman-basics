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

$this->title = Yii::t('menu', 'افزودن منو');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('menu', 'مدیریت منو'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
