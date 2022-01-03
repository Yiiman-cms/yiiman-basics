<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\form\models\Form */

$this->title = Yii::t('form', 'ثبت فرم ها');
$this->params['breadcrumbs'][] = ['label' => Yii::t('form', 'فرم ساز'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
