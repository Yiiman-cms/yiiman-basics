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
/* @var $model \YiiMan\YiiBasics\modules\menumodern\models\Menu */

$this->title = Yii::t(
        'menumodern',
        'بروزرسانی'
    ).' : '.'<span style="color: green">'.$model->name.'</span>';
$this->params['breadcrumbs'][] = [
    'label' => 'منو',
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = [
    'label' => $model->name,
    'url'   => [
        'view',
        'id' => $model->id
    ]
];
$this->params['breadcrumbs'][] = \Yii::t('menumodern', 'بروزرسانی');
?>
<div class="menu-update">

    <h1><?= ($this->title) ?></h1>

    <?= $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
