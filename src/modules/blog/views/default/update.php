<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\blog\models\BlogArticles */

$this->title = Yii::t('blog', 'بروزرسانی مقاله: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'وبلاگ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('blog', 'ویرایش');

\system\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('blog', 'ثبت مقاله'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/blog/default/create'
);

\system\widgets\topMenu\TopMenuWidget::addBtb(
    'assignment',
    Yii::t('blog', 'بازبینی مقاله'),
    'info',
    null,
    Yii::$app->Options->BackendUrl . '/blog/default/view?id=' . $model->id
);

\system\widgets\backLang\backLangWidget::languages($model);

?>
<div class="blog-articles-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
