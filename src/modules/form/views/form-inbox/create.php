<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\form\models\FormInbox */

$this->title = Yii::t('form', 'ثبت اطلاعات ثبت شده');
$this->params['breadcrumbs'][] = ['label' => Yii::t('form', 'فرم ساز'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-inbox-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
