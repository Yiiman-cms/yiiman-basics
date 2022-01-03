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
/* @var $model YiiMan\YiiBasics\modules\product\models\Product */

$this->title = Yii::t('product', 'ثبت محصول');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('product', 'محصولات'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
