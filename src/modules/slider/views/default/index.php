<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\slider\models\SearchSlider */
/* @var $dataProvider yii\data\ActiveDataProvider */

\system\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('slider', 'ثبت اسلاید'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/slider/default/create'
);
\system\widgets\backLang\backLangWidget::languages();

$this->title = Yii::t('slider', 'اسلاید') . ' ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="slider-index">
    <div class="card card-nav-tabs">
        <div class="card-body ">
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

            <div class="row">
                <div class="col-md-12 pull-right">

                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['class'=>\YiiMan\YiiBasics\modules\gallery\grid\ImageColumn::className()],
                            'title',
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'value' => function ($model) {

                                    switch ($model->status) {
                                        case $model::STATUS_ACTIVE:
                                            return '<span style="color:green">انتشار یافته</span>';
                                            break;
                                        case $model::STATUS_DE_ACTIVE:
                                            return '<span
                                                style="color: red">بازبینی</span>';
                                            break;
                                    }
                                },
                            ],


                            ['class' => 'YiiMan\YiiBasics\lib\ActionColumn'],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
