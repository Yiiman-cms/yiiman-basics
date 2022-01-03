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
/* @var $searchModel YiiMan\YiiBasics\modules\ticket\models\SearchTicketDepartments */
/* @var $dataProvider yii\data\ActiveDataProvider */

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('ticket', 'ثبت دپارتمان'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/ticket/ticket-departments/create'
);

$this->title = Yii::t('ticket', 'دپارتمان ها').' ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ticket-departments-index">
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
//                            ['class' => '\YiiMan\YiiBasics\lib\i18n\LanguageColumn'],
                            'title',
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

                            ['class' => 'YiiMan\YiiBasics\lib\ActionColumn'],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
