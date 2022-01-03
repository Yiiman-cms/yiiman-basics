<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\gallery\models\GalleryMedias */

$this->title = Yii::t('gallery', 'ثبت فایل ها');
$this->params['breadcrumbs'][] = ['label' => Yii::t('gallery', 'گالری'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-medias-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
