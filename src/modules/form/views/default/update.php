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
/* @var $model YiiMan\YiiBasics\modules\form\models\Form */

$this->title = Yii::t('form', 'ویرایش فرم ها: '.$model->title, [
    'nameAttribute' => ''.$model->title,
]);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('form', 'ثبت فرم ها'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/form/default/create'
);

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'assignment',
    Yii::t('form', 'بازبینی فرم ها'),
    'info',
    null,
    Yii::$app->Options->BackendUrl.'/form/default/view?id='.$model->id
);


$this->params['breadcrumbs'][] = [
    'label' => Yii::t('form', 'فرم ساز'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url'   => [
        'view',
        'id' => $model->id
    ]
];
$this->params['breadcrumbs'][] = Yii::t('form', 'ویرایش');
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);
?>
<div class="form-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
