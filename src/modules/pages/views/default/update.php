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
/* @var $model YiiMan\YiiBasics\modules\pages\models\Pages */

$this->title = Yii::t('pages', 'ویرایش برگه: '.$model->title, [
    'nameAttribute' => ''.$model->title,
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('pages', 'برگه ها'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url'   => [
        'view',
        'id' => $model->id
    ]
];
$this->params['breadcrumbs'][] = Yii::t('pages', 'ویرایش برگه ');


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('pages', 'ثبت برگه ها'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/pages/default/create'
);

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'assignment',
    Yii::t('pages', 'بازبینی برگه ها'),
    'info',
    null,
    Yii::$app->Options->BackendUrl.'/pages/default/view?id='.$model->id
);

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>
<div class="pages-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
