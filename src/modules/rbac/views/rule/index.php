<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;

/* @var $this yii\web\View */
/* @var $searchModel \YiiMan\YiiBasics\modules\rbac\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac', 'Rules Manager');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="auth-item-index">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-nav-tabs">
                <div class="card-body ">
                    <h4 class="text-center"></h4>
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <?= GridView::widget(
                                [
                                    'id'                => 'crud-datatable',
                                    'dataProvider'      => $dataProvider,
                                    'filterModel'       => $searchModel,
                                    'pjax'              => true,
                                    'columns'           => require(__DIR__.'/_columns.php'),
                                    'toggleDataOptions' => [
                                        'all'  => [
                                            'icon'  => 'resize-full',
                                            'class' => 'btn btn-default',
                                            'label' => Yii::t('rbac', 'All'),
                                            'title' => Yii::t('rbac', 'Show all data')
                                        ],
                                        'page' => [
                                            'icon'  => 'resize-small',
                                            'class' => 'btn btn-default',
                                            'label' => Yii::t('rbac', 'Page'),
                                            'title' => Yii::t('rbac', 'Show first page data')
                                        ],
                                    ],
                                    'toolbar'           => [
                                        [
                                            'content' =>
                                                Html::a(
                                                    '<i class="glyphicon glyphicon-plus"></i>',
                                                    ['create'],
                                                    [
                                                        'role'  => 'modal-remote',
                                                        'title' => Yii::t('rbac', 'Create new rule'),
                                                        'class' => 'btn btn-success'
                                                    ]
                                                ).
                                                Html::a(
                                                    '<i class="glyphicon glyphicon-repeat"></i>',
                                                    [''],
                                                    [
                                                        'data-pjax' => 1,
                                                        'class'     => 'btn btn-info',
                                                        'title'     => Yii::t('rbac', 'Reload Grid')
                                                    ]
                                                ).
                                                '{toggleData}'.
                                                '{export}'
                                        ],
                                    ],
                                    'striped'           => true,
                                    'condensed'         => true,
                                    'responsive'        => true,
                                    'panel'             => [
                                        'type'    => 'primary',
                                        'heading' => '<i class="glyphicon glyphicon-list"></i> '.$this->title,
                                        'before'  => '<em>'.Yii::t(
                                                'rbac',
                                                '* Resize table columns just like a spreadsheet by dragging the column edges.'
                                            ).'</em>',
                                        'after'   => false,
                                    ]
                                ]
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

