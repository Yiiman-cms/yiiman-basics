<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\ticket\models\TicketDepartmentUsers */

$this->title = Yii::t('ticket', 'ویرایش : ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('ticket', 'ثبت '),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/ticket-department-users/default/create'
);

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('ticket', 'بازبینی '),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/ticket-department-users/default/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('ticket', 'تیکت'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ticket', 'ویرایش');
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);
?>
<div class="ticket-department-users-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
