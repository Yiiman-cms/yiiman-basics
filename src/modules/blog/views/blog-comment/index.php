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
/* @var $searchModel YiiMan\YiiBasics\modules\blog\models\SearchBlogComment */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('blog', 'دیدگاه ها').' ';
$this->params['breadcrumbs'][] = $this->title;

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('blog', 'ثبت دیدگاه جدید'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/blog/default/create'
);
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages();

$verified = \Yii::t('site', 'منتشر شده');
$unverified = \Yii::t('site', 'جفنگ(منتشر نشده)');
$js = <<<JS
function verifiedFunction(el){
    var verify= el.attr('verify')?true:false;
    var vtext='{$verified}';
    var uvtext='{$unverified}';
    var row=el.closest('tr');
    if (verify){
        row.css('background-color','');
        row.find('td').last().prev().text(vtext);
    }else{
        row.css('background-color','#ff001821');
        row.find('td').last().prev().text(uvtext);
    }
    el.parent().find('.glyphicon-remove').remove();
    el.parent().find('.glyphicon-ok').remove();
    // el.remove();
    
}
JS;
$this->registerJs($js, $this::POS_END);

?>
<style>
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 12px 8px;
        vertical-align: middle;
        line-height: 20px;
    }

    .card .table tr:first-child td {
        border-top: none;
        height: 17px !important;
        line-height: 23px;
    }

    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 2px 10px;
        vertical-align: middle;
        line-height: 20px;
    }

    .glyphicon.glyphicon-ok {
        background-color: green;
    }

    .glyphicon.glyphicon-remove {
        background: red;
    }
</style>
<div class="blog-comment-index">

    <div class="card card-nav-tabs">
        <div class="card-body ">
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

            <div class="row">
                <div class="col-md-12 pull-right">

                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel'  => $searchModel,
                        'rowOptions'   => function ($model) {
                            /**
                             * @var $model \YiiMan\YiiBasics\modules\blog\models\BlogComment
                             */
                            switch ($model->status) {
                                case $model::STATUS_ACTIVE:

                                    break;
                                case $model::STATUS_DE_ACTIVE:
                                    return
                                        [
                                            'style' => 'background:#ff001821'
                                        ];
                                    break;
                                case $model::STATUS_WAITING:
                                    return
                                        [
                                            'style' => 'background:#ffa50040'
                                        ];
                                    break;
                            }
                        },
                        'columns'      => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'message',
                            'name',
                            'email:email',
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
                                            return \Yii::t('blog', 'جفنگ(منتشر نشده)');
                                            break;
                                        case 2:
                                            return \Yii::t('blog', 'در انتظار تایید');
                                            break;
                                    }
                                },
                            ],

                            [
                                'class'    => 'yii\grid\ActionColumn',
                                'template' => '{view} {update} {delete} {verify} {un-verify}',
                                'buttons'  =>
                                    [
                                        'verify'    =>
                                            function ($url, $model, $key) {
                                                /**
                                                 * @var $model \YiiMan\YiiBasics\modules\blog\models\BlogComment
                                                 */
                                                if ($model->status == $model::STATUS_WAITING) {

                                                    $title = Yii::t('blog', 'تایید');

                                                    $options =
                                                        [
                                                            'title'              => $title,
                                                            'data-tippy-content' => $title,
                                                            'data-pjax'          => '1',
                                                            'done'               => 'verifiedFunction',
                                                            'verify'             => 'verify'
                                                        ];
                                                    $icon = Html::tag('span', '',
                                                        ['class' => "glyphicon glyphicon-ok"]);
                                                    return Html::a($icon, $url, $options);
                                                } else {
                                                    return '';
                                                }
                                            },
                                        'un-verify' =>
                                            function ($url, $model, $key) {
                                                /**
                                                 * @var $model \YiiMan\YiiBasics\modules\blog\models\BlogComment
                                                 */
                                                if ($model->status == $model::STATUS_WAITING) {

                                                    $title = Yii::t('blog', 'رد کردن');

                                                    $options =
                                                        [
                                                            'title'              => $title,
                                                            'data-tippy-content' => $title,
                                                            'data-pjax'          => '1',
                                                            'done'               => 'verifiedFunction',
                                                            'unverify'           => 'unverify'
                                                        ];
                                                    $icon = Html::tag('span', '',
                                                        ['class' => "glyphicon glyphicon-remove"]);
                                                    return Html::a($icon, $url, $options);
                                                } else {
                                                    return '';
                                                }
                                            },


                                    ]
                            ],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
