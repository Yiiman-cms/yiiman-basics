<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use YiiMan\YiiBasics\modules\pages\models\Pages;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\pages\models\Pages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('pages', 'صفحات'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('pages', 'ثبت صفحه'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/pages/default/create'
);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('pages', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl.'/pages/default/update?id='.$model->id);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('pages', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl.'/pages/default/delete?id='.$model->id);

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>
<style>
    .badge {
        margin-right: 6px;
        background-color: green;
    }
</style>
<div class="pages-view">

    <h3 class="text-center">Page:<?= Html::encode($this->title) ?></h3>
    <div class="row">
        <div class="col-md-3" style="margin-top: 10px">
            <div class="card card-nav-tabs">
                <div class="card-body ">
                    <h4 class="text-center">Details</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Slug</th>
                                    <td><?= $model->slug ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?php
                                        switch ($model->status) {
                                            case $model::STATUS_ACTIVE:
                                                echo '<span style="color: green">Published</span>';
                                                break;
                                            case $model::STATUS_DE_ACTIVE:
                                                echo '<span style="color: red">Review</span>';
                                                break;
                                        }
                                        ?></td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9" style="margin-top: 10px">
            <div class="card card-nav-tabs">
                <div class="card-body ">

                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <h4 class="text-center bold">Seo Descriptions</h4>
                            <hr>
                            <?php
                            $seo = Yii::$app->MetaLib->get(Pages::SEO_DESCRIPTION_METADATA, $model->id);
                            if (!empty($seo)) {
                                echo $seo->content;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <h4 class="text-center bold">Seo Tags</h4>
                            <hr>
                            <?php
                            $seo = Yii::$app->MetaLib->get(Pages::SEO_TAG, $model->id);
                            if (!empty($seo)) {
                                $text = '';
                                if (is_array($seo)) {

                                    foreach ($seo as $key => $item) {
                                        $text .= '<span class="badge badge-pill badge-info">'.$item->content.'</span>';
                                    }
                                } else {
                                    $text .= '<span class="badge badge-pill badge-info">'.$seo->content.'</span>';
                                }
                                echo $text;
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-top: 10px">
            <div class="card card-nav-tabs">
                <div class="card-body ">
                    <h4 class="text-center">Content</h4>
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <?= $model->content ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
