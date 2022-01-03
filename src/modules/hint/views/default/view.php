<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\hint\models\Hint */

$this->title = $model->id;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('hint', 'Hints'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hint-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a(Yii::t('hint', 'Update'), [
            'update',
            'id' => $model->id
        ], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('hint', 'Delete'), [
            'delete',
            'id' => $model->id
        ], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => Yii::t('hint', 'Do You Want Delete This Item?'),
                'method'  => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('hint', 'Save Hint'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date',
            'count',
            'url:url',
        ],
    ]) ?>

</div>
