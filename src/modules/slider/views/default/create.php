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
/* @var $model YiiMan\YiiBasics\modules\slider\models\Slider */

$this->title = Yii::t('slider', 'ثبت اسلاید');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('slider', 'اسلاید'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
