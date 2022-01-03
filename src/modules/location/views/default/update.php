<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\location\models\LocationCity */

$this->title = Yii::t('location', 'ویرایش شهر : ' . $model->name, [
    'nameAttribute' => '' . $model->name,
]);


\system\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('location', 'ثبت شهر ها'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/location/default/create'
);

\system\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('location', 'بازبینی شهر ها'),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/location/default/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('location', 'موقعیت جغرافیایی'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('location', 'ویرایش');
\system\widgets\backLang\backLangWidget::languages($model);
?>
<div class="location-city-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
