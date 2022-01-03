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
/* @var $model YiiMan\YiiBasics\modules\seo\models\SeoFlagContents */

$this->title = $model->title;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('seo', 'سئوs'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('seo', 'ثبت کلید واژه راهنما'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/seo/default/create'
);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('seo', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl.'/seo/default/update?id='.$model->id);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('seo', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl.'/seo/default/delete?id='.$model->id);

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>
<div class="seo-flag-contents-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            [
                'attribute' => 'link',
                'val'       => function ($model) {
                    if (!empty($model->link)) {
                        return '<a href="'.$model->link.'" target="_blank">'.$model->link.'</a>';
                    }
                },
                'format'    => 'raw'
            ],
            [
                'attribute' => 'short_content',
                'format'    => 'raw'
            ],
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
        ],
    ]) ?>

</div>
