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
/* @var $model YiiMan\YiiBasics\modules\ticket\models\Ticket */

$this->title = Yii::t('ticket', 'ثبت تیکت ها');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('ticket', 'تیکت'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
