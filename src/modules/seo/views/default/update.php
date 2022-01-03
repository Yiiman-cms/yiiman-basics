<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\seo\models\SeoFlagContents */

$this->title = Yii::t('seo', 'ویرایش محتوای پرچم ها: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('seo', 'سئو'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('seo', 'ویرایش');
?>
<div class="seo-flag-contents-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
