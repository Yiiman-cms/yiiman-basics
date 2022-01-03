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
/* @var $model YiiMan\YiiBasics\modules\gallery\models\GalleryFkMediasCategories */

$this->title = Yii::t('gallery', 'ثبت اتصالات فایل ها');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('gallery', 'گالری'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-fk-medias-categories-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
