<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\location\models\LocationNeighbourhood */

$this->title = Yii::t('location', 'ویرایش محله: ' . $model->name, [
    'nameAttribute' => '' . $model->name,
]);


\system\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('location', 'ثبت محلات'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/location/neighbourhood/create'
);

\system\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('location', 'بازبینی محلات'),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/location/neighbourhood/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('location', 'موقعیت جغرافیایی'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('location', 'ویرایش');
\system\widgets\backLang\backLangWidget::languages($model);
?>
<div class="location-neighbourhood-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
