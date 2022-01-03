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
/* @var $model YiiMan\YiiBasics\modules\search\models\Search */


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('search', 'ثبت جست و جوها'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/search/default/create'
);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('search', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl.'/search/default/update?id='.$model->id);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('search', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl.'/search/default/delete?id='.$model->id);


$this->title = Yii::t('search', 'جست و جوها:  '.$model->id);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('search', 'جست و جوها'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>
<div class="search-view">
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
                                    'query',
                                    'resultCount',
                                    'created_at',
                                    'ip',
                                    'result_types:ntext',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
