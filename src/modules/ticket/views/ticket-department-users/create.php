<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\ticket\models\TicketDepartmentUsers */

$this->title = Yii::t('ticket', 'ثبت ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ticket', 'تیکت'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-department-users-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
