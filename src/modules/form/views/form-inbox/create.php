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
/* @var $model YiiMan\YiiBasics\modules\form\models\FormInbox */

$this->title = Yii::t('form', 'ثبت اطلاعات ثبت شده');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('form', 'فرم ساز'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-inbox-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
