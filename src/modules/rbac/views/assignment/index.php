<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac', 'User Assignment');

$this->params['breadcrumbs'][] = $this->title;
\system\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('rbac', 'انتساب دسترسی جدید'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/rbac/assignment/create'
);
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-nav-tabs">
            <div class="card-body ">
                <h4 class="text-center"></h4>
                <div class="row">
                    <div class="col-md-12 pull-right">
                        <?= GridView::widget(
                            [
                                'id' => 'crud-datatable',
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => require __DIR__ . '/_columns.php',
                                'pjax' => true,
                                'striped' => true,
                                'condensed' => true,
                                'responsive' => true,
                                'toggleDataOptions' => [
                                    'all' => [
                                        'icon' => 'resize-full',
                                        'class' => 'btn btn-default',
                                        'label' => Yii::t('rbac', 'All'),
                                        'title' => Yii::t('rbac', 'Show all data')
                                    ],
                                    'page' => [
                                        'icon' => 'resize-small',
                                        'class' => 'btn btn-default',
                                        'label' => Yii::t('rbac', 'Page'),
                                        'title' => Yii::t('rbac', 'Show first page data')
                                    ],
                                ],
                                'toolbar' => [
                                    [
                                        'content' =>
                                            Html::a(
                                                '<i class="glyphicon glyphicon-repeat"></i>',
                                                [''],
                                                [
                                                    'data-pjax' => 1,
                                                    'class' => 'btn btn-default',
                                                    'title' => Yii::t('rbac', 'Reload Grid')
                                                ]
                                            ) .
                                            '{toggleData}'
                                    ],
                                ],
                                'panel' => [
                                    'type' => 'primary',
                                    'heading' => '<i class="glyphicon glyphicon-list"></i> ' . $this->title,
                                    'before' => '<em>' . Yii::t(
                                            'rbac',
                                            '* Resize table columns just like a spreadsheet by dragging the column edges.'
                                        ) . '</em>',
                                    'after' => false,
                                ]
                            ]
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

	



