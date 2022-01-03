<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\ticket\models\TicketDepartments */


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('ticket', 'ثبت دپارتمان ها'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/ticket/ticket-departments/create'
);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('ticket', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl . '/ticket/ticket-departments/update?id=' . $model->id);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('ticket', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl . '/ticket/ticket-departments/delete?id=' . $model->id);


$this->title = Yii::t('ticket', 'دپارتمان ها:  ' . $model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ticket', 'دپارتمان ها'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>
<div class="ticket-departments-view">
    <div class="jumbotron">
        <div class="card card-nav-tabs">
            <div class="card-body ">
                <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
                <div class="row">
                    <div class="col-md-12 pull-right">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'title',
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        /**
                                         * @var $model \common\models\Neighbourhoods
                                         */
                                        switch ($model->status) {
                                            case 1:
                                                return 'فعال';
                                                break;
                                            case 0:
                                                return 'غیرفعال';
                                                break;
                                        }
                                    },
                                ],
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
