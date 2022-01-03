<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\language\models\Language */

$this->title = Yii::t('language', 'ثبت زبان های سایت');
$this->params['breadcrumbs'][] = ['label' => Yii::t('language', 'زبان های سایت'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
