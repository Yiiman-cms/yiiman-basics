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
/* @var $model YiiMan\YiiBasics\modules\transactions\models\Transactions */

$this->title = Yii::t('transactions', 'ثبت تراکنش ها');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('transactions', 'مالی'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
