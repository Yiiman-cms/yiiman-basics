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
/* @var $model YiiMan\YiiBasics\modules\blog\models\BlogArticles */

$this->title = Yii::t('blog', 'بروزرسانی مقاله: '.$model->title, [
    'nameAttribute' => ''.$model->title,
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('blog', 'وبلاگ'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url'   => [
        'view',
        'id' => $model->id
    ]
];
$this->params['breadcrumbs'][] = Yii::t('blog', 'ویرایش');

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('blog', 'ثبت مقاله'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/blog/default/create'
);

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'assignment',
    Yii::t('blog', 'بازبینی مقاله'),
    'info',
    null,
    Yii::$app->Options->BackendUrl.'/blog/default/view?id='.$model->id
);

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>
<div class="blog-articles-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
