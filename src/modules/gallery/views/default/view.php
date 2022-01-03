<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\gallery\models\GalleryCategories */


\system\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('gallery', 'ثبت پوشه ها'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/gallery/default/create'
);


\system\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('gallery', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl . '/gallery/default/update?id=' . $model->id);


\system\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('gallery', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl . '/gallery/default/delete?id=' . $model->id);


$this->title = Yii::t('gallery', 'پوشه ها:  ' . $model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('gallery', 'گالری'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\system\widgets\backLang\backLangWidget::languages($model);

?>
<div class="gallery-categories-view">
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
                                    'description:ntext',
                                    [
                                        'attribute' => 'image',
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                            return MediaViewWidget::widget(['attribute' => 'image', 'model' => $model]);
                                        }
                                    ],
                                    'parent',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
