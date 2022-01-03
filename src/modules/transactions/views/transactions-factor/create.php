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
/* @var $model YiiMan\YiiBasics\modules\transactions\models\TransactionsFactor */

$this->title = Yii::t('transactions', 'ثبت فاکتور ها');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('transactions', 'مالی'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-factor-head-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
