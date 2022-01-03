<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\ticket\models\TicketDepartments */

$this->title = Yii::t('ticket', 'ویرایش دپارتمان ها: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);


\system\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('ticket', 'ثبت دپارتمان ها'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/ticket/ticket-departments/create'
);

\system\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('ticket', 'بازبینی دپارتمان ها'),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/ticket/ticket-departments/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('ticket', 'دپارتمان ها'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ticket', 'ویرایش');
?>
<div class="ticket-departments-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
