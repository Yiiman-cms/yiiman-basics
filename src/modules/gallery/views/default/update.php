<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\gallery\models\GalleryCategories */

$this->title = Yii::t('gallery', 'ویرایش پوشه ها: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('gallery', 'ثبت پوشه ها'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/gallery/default/create'
);

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'assignment',
    Yii::t('gallery', 'بازبینی پوشه ها'),
    'info',
    null,
    Yii::$app->Options->BackendUrl . '/gallery/default/view?id=' . $model->id
);


$this->params['breadcrumbs'][] = ['label' => Yii::t('gallery', 'گالری'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('gallery', 'ویرایش');
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);
?>
<div class="gallery-categories-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
