<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\slider\models\Slider */

$this->title = Yii::t('slider', 'ویرایش اسلاید: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);


\system\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('slider', 'ثبت اسلاید'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/slider/default/create'
);

\system\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('slider', 'بازبینی اسلاید'),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/slider/default/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('slider', 'اسلاید'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('slider', 'ویرایش');
\system\widgets\backLang\backLangWidget::languages($model);
?>
<div class="slider-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
