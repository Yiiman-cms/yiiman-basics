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
/* @var $model YiiMan\YiiBasics\modules\widget\models\Widget */

$this->title = Yii::t('widget', 'ثبت ویجت');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('widget', 'ویجت'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
