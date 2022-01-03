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
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\ticket\models\Ticket */

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('ticket', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl.'/ticket/default/update?id='.$model->id);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('ticket', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl.'/ticket/default/delete?id='.$model->id);


$this->title = Yii::t('ticket', 'تیکت ها:  '.$model->id);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('ticket', 'تیکت'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>
<div class="ticket-view">
    <div class="container">
        <div class="jumbotron">
            <div class="viewLanguagebox">
                زبان های ست شده:
                <?= (new \YiiMan\YiiBasics\lib\i18n\LanguageColumn())->renderDataCell($model, 0, 0) ?>
            </div>
            <div class="card card-nav-tabs">
                <div class="card-body ">
                    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'subject',
                                    'created_at',
                                    'created_by',
                                    'updated_at',
                                    'updated_by',
                                    [
                                        'attribute' => 'status',
                                        'value'     => function ($model) {
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
                                    'department',
                                    'deleted_at',
                                    'deleted_by',
                                    'closed_at',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
