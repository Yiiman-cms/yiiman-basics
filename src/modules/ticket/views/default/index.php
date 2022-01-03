<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\ticket\models\SearchTicket */
/* @var $dataProvider yii\data\ActiveDataProvider */

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('ticket', 'ثبت تیکت ها'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/ticket/default/create'
);

$this->title = Yii::t('ticket', 'تیکت ها').' ';
$this->params['breadcrumbs'][] = $this->title;

$viewUrl = Yii::$app->urlManager->createUrl(['/ticket/default/update?id=']);
$js = <<<JS
$('tbody tr').click(function(e){
    window.location.href='{$viewUrl}'+$(this).attr('data-key');
});
JS;
$this->registerJs($js, $this::POS_END);
?>
<style>
    tbody tr {
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="col-md-12">
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
                            'columns'      =>
                                [
                                    'serial',
                                    'subject',
                                    [
                                        'attribute' => 'created_at',
                                        'value'     => function ($model) {
                                            return Yii::$app->functions->convertdatetime($model->created_at);
                                        }
                                    ],
                                    [
                                        'attribute' => 'updated_at',
                                        'value'     => function ($model) {
                                            return Yii::$app->functions->convertdatetime($model->updated_at);
                                        }
                                    ],
                                    //'updated_by',
                                    [
                                        'attribute' => 'status',
                                        'value'     => function ($model) {
                                            /**
                                             * @var $model \YiiMan\YiiBasics\modules\ticket\models\Ticket
                                             */
                                            return $model::statuses_html[$model->status];
                                        },
                                        'format'    => 'raw'
                                    ],
                                    //'department',
                                    //'deleted_at',
                                    //'deleted_by',
                                    //'closed_at',
                                ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>


            </div>


        </div>
    </div>
</div>

