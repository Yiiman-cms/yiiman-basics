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

$this->title = Yii::t('ticket', 'ویرایش تیکت : '.$model->serial, [
    'nameAttribute' => ''.$model->id,
]);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'assignment',
    Yii::t('ticket', 'بازبینی تیکت '),
    'info',
    null,
    Yii::$app->Options->BackendUrl.'/ticket/default/view?id='.$model->id
);


$this->params['breadcrumbs'][] = [
    'label' => Yii::t('ticket', 'تیکت'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = [
    'label' => $model->id,
    'url'   => [
        'view',
        'id' => $model->id
    ]
];
$this->params['breadcrumbs'][] = Yii::t('ticket', 'ویرایش');
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);
?>
<div class="ticket-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
