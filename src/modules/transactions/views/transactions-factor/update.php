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

$this->title = Yii::t('transactions', 'ویرایش فاکتور ها: '.$model->id, [
    'nameAttribute' => ''.$model->id,
]);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('transactions', 'ثبت فاکتور ها'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/transactions-factor-head/default/create'
);

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'assignment',
    Yii::t('transactions', 'بازبینی فاکتور ها'),
    'info',
    null,
    Yii::$app->Options->BackendUrl.'/transactions-factor-head/default/view?id='.$model->id
);


$this->params['breadcrumbs'][] = [
    'label' => Yii::t('transactions', 'مالی'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = [
    'label' => $model->id,
    'url'   => [
        'view',
        'id' => $model->id
    ]
];
$this->params['breadcrumbs'][] = Yii::t('transactions', 'ویرایش');
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);
?>
<div class="transactions-factor-head-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
