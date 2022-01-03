<?php
use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\seo\models\SeoFlags */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('seo', 'سئوs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-flags-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a(Yii::t('seo', 'بروزرسانی'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('seo', 'جذف'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('seo', 'آیا برای حذف این مورد اطمینان دارید؟?'),
                'method' => 'post',
            ],
        ]) ?>
	    <?= Html::a(Yii::t('seo', 'ثبت پرچم ها'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'flag',
            'content',
        ],
    ]) ?>

</div>
