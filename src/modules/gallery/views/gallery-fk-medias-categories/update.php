<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\gallery\models\GalleryFkMediasCategories */

$this->title = Yii::t('gallery', 'ویرایش اتصالات فایل ها: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);


\system\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('gallery', 'ثبت اتصالات فایل ها'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/gallery-fk-medias-categories/default/create'
);

\system\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('gallery', 'بازبینی اتصالات فایل ها'),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/gallery-fk-medias-categories/default/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('gallery', 'گالری'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('gallery', 'ویرایش');
\system\widgets\backLang\backLangWidget::languages($model);
?>
<div class="gallery-fk-medias-categories-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
