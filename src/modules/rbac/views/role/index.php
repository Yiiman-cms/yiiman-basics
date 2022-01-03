<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;

/* @var $this yii\web\View */
/* @var $searchModel \YiiMan\YiiBasics\modules\rbac\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac', 'Roles Manager');
$this->params['breadcrumbs'][] = $this->title;
\system\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('rbac', 'ثبت نقش'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/rbac/role/create'
);
?>

<div class="auth-item-index">
    <div id="ajaxCrudDatatable">

        <div class="card card-nav-tabs">
            <div class="card-body ">
                <h3 class="text-center"></h3>

                <div class="row">
                    <div class="col-md-12 pull-right">
                        <?=
                        GridView::widget(
                            [
                                'id' => 'crud-datatable',
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'pjax' => true,
                                'columns' => require(__DIR__ . '/_columns.php'),
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
                                                    'title' => Yii::t('rbac', 'بازنشانی جست و جو')
                                                ]
                                            ) .
                                            '{toggleData}' .
                                            '{export}'
                                    ],
                                ],
                                'striped' => true,
                                'condensed' => true,
                                'responsive' => true,
                                'panel' => [
                                    'type' => 'primary',
                                    'heading' => '<i class="glyphicon glyphicon-list"></i> ' . $this->title,

                                    'after' => false,
                                ]
                            ]
                        )
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

