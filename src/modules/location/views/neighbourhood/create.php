<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\location\models\LocationNeighbourhood */

$this->title = Yii::t('location', 'ثبت محله');
$this->params['breadcrumbs'][] = ['label' => Yii::t('location', 'موقعیت جغرافیایی'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-neighbourhood-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
