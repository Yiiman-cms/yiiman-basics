<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\ticket\models\TicketMessages */

$this->title = Yii::t('ticket', 'ویرایش : ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);


\system\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('ticket', 'ثبت '),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/ticket-messages/default/create'
);

\system\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('ticket', 'بازبینی '),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/ticket-messages/default/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('ticket', 'تیکت'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ticket', 'ویرایش');
\system\widgets\backLang\backLangWidget::languages($model);
?>
<div class="ticket-messages-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
