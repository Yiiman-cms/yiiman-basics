<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\seo\models\SeoFlagContents */

$this->title = Yii::t('seo', 'ثبت محتوای پرچم ها');
$this->params['breadcrumbs'][] = ['label' => Yii::t('seo', 'سئوs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-flag-contents-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
