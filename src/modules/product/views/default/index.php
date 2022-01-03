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
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\product\models\SearchProduct */
/* @var $dataProvider yii\data\ActiveDataProvider */

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('product', 'ثبت محصول'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/product/default/create'
);
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages();

$this->title = Yii::t('product', 'محصول').' ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-index">
    <div class="card card-nav-tabs">
        <div class="card-body ">
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

            <div class="row">
                <div class="col-md-12 pull-right">

                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel'  => $searchModel,
                        'columns'      => [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['class' => '\YiiMan\YiiBasics\lib\i18n\LanguageColumn'],
                            'hash',
                            'title',
                            'description:ntext',
                            [
                                'attribute' => 'status',
                                'format'    => 'raw',
                                'value'     => function ($model) {

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
                            //'code',
                            //'unit',
                            //'weight',
                            //'discount',
                            //'hit',
                            //'sold',
                            //'created_at',
                            //'updated_at',
                            //'json_data:ntext',

                            ['class' => 'YiiMan\YiiBasics\lib\ActionColumn'],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
