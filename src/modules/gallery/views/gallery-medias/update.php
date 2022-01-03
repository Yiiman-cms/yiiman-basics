<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\gallery\models\GalleryMedias */

$this->title = Yii::t('gallery', 'ویرایش فایل ها: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('gallery', 'ثبت فایل ها'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/gallery-medias/default/create'
);

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('gallery', 'بازبینی فایل ها'),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/gallery-medias/default/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('gallery', 'گالری'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('gallery', 'ویرایش');
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);
?>
<div class="gallery-medias-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
