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
/* @var $model YiiMan\YiiBasics\modules\blog\models\BlogComment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('blog', 'وبلاگ'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('blog', 'ثبت دیدگاه'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/blog/default/create'
);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('blog', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl.'/blog/default/update?id='.$model->id);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('blog', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl.'/blog/default/delete?id='.$model->id);


?>
<div class="blog-comment-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'message',
            'name',
            'email:email',
            [
                'attribute' => 'created_at',
                'value'     => function ($model) {

                    return Yii::$app->functions->convert_date($model->created_at).' - '.
                        Yii::$app->functions->timeLeft($model->created_at);
                }
            ],
            [
                'attribute' => 'article',
                'format'    => 'raw',
                'value'     => function ($model) {
                    /**
                     * @var $model \YiiMan\YiiBasics\modules\blog\models\BlogComment
                     */
                    if (!empty($a=$model->article0)) {

                        return '<a target="_blank" href="/article?id='.$model->article.'">'.$a->title.'</a>';
                    }
                }
            ],
            //'created_at',
            [
                'attribute' => 'status',
                'value'     => function ($model) {
                    /**
                     * @var $model
                     */
                    switch ($model->status) {
                        case 1:
                            return \Yii::t('blog', 'منتشر شده');
                            break;
                        case 0:
                            return \Yii::t('blog', 'جفنگ');
                            break;
                        case 2:
                            return \Yii::t('blog', 'در انتظار تایید');
                            break;
                    }
                },
            ],

        ],
    ]) ?>
</div>
