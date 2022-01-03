<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\ticket\models\TicketDepartments */

$this->title = Yii::t('ticket', 'ثبت دپارتمان ها');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ticket', 'دپارتمان ها'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-departments-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
