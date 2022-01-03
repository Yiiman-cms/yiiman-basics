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
/* @var $searchModel YiiMan\YiiBasics\modules\useradmin\models\SearchUser */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user', 'Manage Users').' ';
$this->params['breadcrumbs'][] = $this->title;
\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('useradmin', 'ثبت کاربر'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/useradmin/default/create'
);
?>

<div class="user-index">

    <div class="row">
        <?php
        if (!empty($dataProvider->models)) {
            foreach ($dataProvider->models as $item) {
                /**
                 * @var $item \YiiMan\YiiBasics\modules\useradmin\models\User
                 */
                ?>
                <div class="col-md-4">
                    <div class="card card-nav-tabs">
                        <div class="card-body ">
                            <h4 class="text-center"><?= $item->email ?></h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 pull-right">
                                    <img src="<?= Yii::$app->UploadManager->getImageUrl($item, 'image') ?>"
                                         alt="<?= $item->email ?>" class="img img-rounded center-block">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="text-center">Status: <?php
                                        switch ($item->status) {
                                            case $item::STATUS_ACTIVE:
                                                echo 'Active';
                                                break;
                                            case $item::STATUS_DE_ACTIVE:
                                                echo 'DE_ACTIVE';
                                                break;
                                            default:
                                                echo 'DE_ACTIVE';
                                                break;
                                        }
                                        ?></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="btn btn-danger"
                                       href="<?= Yii::$app->urlManager->createUrl(
                                           ['/useradmin/default/delete?id='.$item->id]
                                       ) ?>"
                                    >حذف</a>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-success"
                                       href="<?= Yii::$app->urlManager->createUrl(
                                           ['/useradmin/default/update?id='.$item->id]
                                       ) ?>">بروزرسانی</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
