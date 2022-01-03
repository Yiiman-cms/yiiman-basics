<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\widget\models\Widget */


\system\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('widget', 'ثبت ویجت'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/widget/default/create'
);


\system\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('widget', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl . '/widget/default/update?id=' . $model->id);


\system\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('widget', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl . '/widget/default/delete?id=' . $model->id);


$this->title = Yii::t('widget', 'ویجت:  ' . $model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('widget', 'ویجت'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\system\widgets\backLang\backLangWidget::languages($model);

?>
<div class="widget-view">
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
                                    [
                                        'attribute' => 'content',
                                        'format' => 'raw'
                                    ],
                                    'shortCode',
                                    'title',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
