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
/* @var $model YiiMan\YiiBasics\modules\location\models\LocationCity */

$this->title = Yii::t('location', 'ثبت شهر ');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('location', 'موقعیت جغرافیایی'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-city-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
