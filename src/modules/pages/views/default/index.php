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
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\pages\models\SearchPages */
/* @var $dataProvider yii\data\ActiveDataProvider */
/**
 * @var $model \YiiMan\YiiBasics\modules\pages\models\Pages
 */
$this->title = Yii::t('pages', 'صفحات').' ';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs($this->render('script/app.js'), $this::POS_END);
$this->registerJs($this->render('script/app.js'), $this::POS_END);
\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('pages', 'ثبت صفحه'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/pages/default/create'
);
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages();
$setDefaultURL = Yii::$app->urlManager->createUrl(['/pages/default/set-default']);
$js = <<<JS
function actionDefault(id) {
                        $('.set-default').show();
                        $('.card[data-id='+id+']').find('.set-default').hide();
                        $('h5').hide();
                        $('.card[data-id='+id+']').find('h5').show();
}
JS;
$this->registerJs($js, \YiiMan\YiiBasics\lib\View::POS_END);
?>
<style>
    iframe {
        width: 100%;
        /* scale: 30%; */
        /* left: 0; */
        /* margin: -1px; */
        /* right: 0; */
        /* position: relative; */
        /* float: left; */
        flex-grow: 1;
        flex-basis: 10px;
        /* transform: scale(0.25) translateX(-150%) translateY(-67%); */
        height: 100vh;
        /* position: relative; */
        border: none;
    }

    .modal-lg {
        width: 96%;
    }

    .modal .modal-dialog {
        margin-top: 300px;
    }

    ul.row {
        display: flex;
        flex-wrap: wrap;
        list-style: none;
        flex-direction: row;
    }

    .h5-default {
        color: #034a119c;
        text-align: center;
        margin: 0;
        margin-bottom: -16px;
    }

    .pull-left.btn.btn-danger.btn-round {
        position: absolute;
        top: -20px;
        border-radius: 5px;
        width: 10px;
        padding-left: 12px;
        right: -11px;
    }

    .card-body.home {
        border: #0080002b 1px solid;
    }

    .pull-right.btn.btn-success.btn-round {
        position: absolute;
        right: -11px;
        border-radius: 5px;
        bottom: -20px;
        padding-right: 27px;
        width: 0px;
        padding-left: 15px;
    }

    .pull-right.set-as-home.btn-warning {
        position: absolute;
        left: -10px;
        padding: 6px;
        border-radius: 4px;
        bottom: -10px;
        color: white;
    }
    .pull-right.btn.btn-info.btn-round {
        position: absolute;
        /* bottom: -20px; */
        left: 0;
        left: -11px;
        width: 8px;
        padding-left: 12px;
        border-radius: 6px;
        top: -21px;
    }
</style>
<div class="pages-index">
    <div class="col-md-12">
        <?php
        $count = 1;
        if (!empty($dataProvider->models)) {
            foreach ($dataProvider->models as $key => $model) {
                if ($count === 1) {
                    echo '<div class="row">';
                }
                if ($count === 4) {
                    echo '</div>';
                    $count = 1;
                    echo '<div class="row">';
                }
                ?>
                <div class="col-md-4" style="margin-bottom:20px">
                    <div class="card card-nav-tabs" data-id="<?= $model->id ?>">
                        <div class="card-body <?= !empty($model->default) ? ' home ' : '' ?>">
                            <h4 class="text-center"><?= $model->title ?></h4>
                            <h5 class="h5-default" <?= empty($model->default) ? 'style="display:none"' : '' ?>><?= \Yii::t('site',
                                    'صفحه ی نخست') ?></h5>
                            <hr>
                            <?php
                            if ($model->status == $model::STATUS_ACTIVE) {
                                ?>
                                <div class="row">
                                    <div class="col-md-6" style="margin: auto;display: block;float: none">

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <ul class="row">
                                <li>
                                    <a
                                            href="<?= Yii::$app->urlManager->createUrl(
                                                ['/pages/default/delete?id='.$model->id]
                                            ) ?>" class="pull-left btn btn-danger btn-round"
                                            data-confirm="Are you sure you want to delete this item?"
                                            data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
                                </li>


                                <li>
                                    <a href="<?= Yii::$app->urlManager->createUrl(['/pages/widget?id='.$model->id]) ?>"
                                       class="pull-right btn btn-success btn-round" title="ویرایشگر بصری"><span
                                                class="glyphicon glyphicon-pencil"></span></a>
                                </li>
                                <?php if ($model->status = $model::STATUS_ACTIVE) {
                                    $url='';
                                    if (!empty($model->slug)) {
                                        $url='/'.$model->slug;
                                    }else{
                                        $url='/site/page?id='.$model->id;
                                    }
                                    ?>
                                    <li>
                                        <a href="<?= $url ?>" target="_blank"
                                           class="pull-right btn btn-info btn-round" title="نمایش صفحه"><span
                                                    class="glyphicon glyphicon-eye-open"></span></a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li class="set-default " <?= !empty($model->default) ? 'style="display:none"' : '' ?>>
                                    <a href="<?=
                                    //                                    /pages/widget?id=6

                                    Yii::$app->urlManager->createUrl(
                                        ['/pages/default/set-default?id='.$model->id]
                                    ) ?>"
                                       done="actionDefault(<?= $model->id ?>)"
                                       class="pull-right set-as-home btn-warning"
                                       style="font-size: 10px;margin-top: 14px;"
                                       title="تنظیم به عنوان صفحه ی نخست">تنظیم به عنوان صفحه ی نخست</a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
                <?php

                if (empty($dataProvider->models[$key + 1])) {
                    echo '</div>';
                }
                $count++;
            }
        }
        ?>
    </div>
</div>
