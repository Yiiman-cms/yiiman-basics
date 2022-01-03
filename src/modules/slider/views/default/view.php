<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\slider\models\Slider */


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('slider', 'ثبت اسلاید'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/slider/default/create'
);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('slider', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl . '/slider/default/update?id=' . $model->id);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('slider', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl . '/slider/default/delete?id=' . $model->id);


$this->title = Yii::t('slider', 'اسلاید:  ' . $model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('slider', 'اسلاید'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>
<div class="slider-view">
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
                                    'title',
                                    'index',
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
                                    [
                                        'attribute' => 'data',
                                        'format' => 'raw',
                                        'value'=>function($model){
                                            return \YiiMan\YiiBasics\theme\Widgets\Slider::widget();
                                        }
                                    ],
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
