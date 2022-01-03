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
/* @var $model YiiMan\YiiBasics\modules\menu\models\Menu */

$this->title = \Yii::t('menu', 'اطلاعات منوی: ').$model->title;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('menu', 'لیست منوهای سایت'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('menu', 'ثبت منو'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/menu/default/create'
);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('menu', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl.'/menu/default/update?id='.$model->id);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('menu', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl.'/menu/default/delete?id='.$model->id);

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);
\YiiMan\YiiBasics\widgets\multiRowInput\assets\FontAwesomeAsset::register($this);
?>
<div class="menu-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'url:url',

            'location',
            [
                'attribute' => 'icon',
                'value'     => function ($model) {
                    return '<i class="'.$model->icon.'"></i>';
                },
                'format'    => 'raw'
            ],
            [
                'attribute' => 'status',
                'value'     => function ($model) {

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
