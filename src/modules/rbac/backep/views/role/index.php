<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('backend', 'Menu - Users Role');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@assets/js/page_number.js');
?>
<div class="role-index">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-nav-tabs">
                <div class="card-body ">
                    <h4 class="text-center"></h4>
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <div class="row">
                                <div class="col-lg-2">
                                    <?= Html::a(
                                        Yii::t('backend', 'Create Role'),
                                        ['create'],
                                        ['class' => 'btn btn-success btn-block']
                                    ) ?>
                                </div>
                                <div class="col-lg-2">
                                    <?= Html::dropDownList(
                                        'per-page',
                                        $dataProvider->pagination->pageSize,
                                        [5   => 5,
                                         10  => 10,
                                         20  => 20,
                                         50  => 50,
                                         100 => 100,
                                         500 => 500
                                        ],
                                        [
                                            'class'    => 'form-control',
                                            'onchange' => 'page_number(this);',
                                            'prompt'   => Yii::t('backend', 'Display Num')
                                        ]
                                    ) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">

                                    <?=
                                    GridView::widget(
                                        [
                                            'dataProvider' => $dataProvider,
//					'filterModel'  => $searchModel ,
                                            'columns'      =>
                                                [
                                                    ['class' => 'yii\grid\SerialColumn'],

                                                    //'id',
                                                    'name',
                                                    [
                                                        'attribute'      => 'description',
                                                        'format'         => 'raw',
                                                        'contentOptions' => ['style' => 'white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width:200px;'],
                                                    ],
                                                    [
                                                        'attribute'      => 'RegisterTime',
                                                        'filter'         => \yii\jui\DatePicker::widget(
                                                            [
                                                                'model'     => $searchModel,
                                                                'attribute' => 'RegisterTime',
                                                                'options'   => [
                                                                    'class' => 'form-control',
                                                                    'style' => 'text-align:center;'
                                                                ]
                                                            ]
                                                        ),
                                                        'contentOptions' => ['style' => 'direction:ltr;text-align:center;width:180px;'],
                                                        'value'          => function ($model) {
                                                            return Yii::$app->functions->convert_date(
                                                                $model->RegisterTime
                                                            );
                                                        },
                                                    ],

                                                    [
                                                        'class'    => 'yii\grid\ActionColumn',
                                                        'template' => '{update}',
                                                    ],
                                                ],
                                        ]
                                    )
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
