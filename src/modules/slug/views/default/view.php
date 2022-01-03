<?php
use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\slug\models\Slug */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('slug', 'Slugs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slug-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a(Yii::t('slug', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('slug', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('slug', 'Do You Want Delete This Item?'),
                'method' => 'post',
            ],
        ]) ?>
	    <?= Html::a(Yii::t('slug', 'Save Slug'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'slug',
            'table_name',
            'table_id',
        ],
    ]) ?>

</div>
