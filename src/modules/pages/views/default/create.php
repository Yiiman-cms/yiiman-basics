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
/* @var $model YiiMan\YiiBasics\modules\pages\models\Pages */

$this->title = Yii::t('pages', 'افزودن برگه ی جدید');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('pages', 'برگه ها'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
