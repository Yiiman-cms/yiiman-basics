<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\blog\models\SearchBlogArticles */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('blog', 'مقالات') . ' ';
$this->params['breadcrumbs'][] = $this->title;
\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('blog', 'ثبت مقاله'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/blog/default/create'
);
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages();
?>

<div class="blog-articles-index">

    <div class="card card-nav-tabs">
        <div class="card-body ">
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

            <div class="row">
                <div class="col-md-12 pull-right">

                    <?php Pjax::begin(); ?>

                    <?= GridView::widget(
                        [
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'class' => \YiiMan\YiiBasics\modules\gallery\grid\ImageColumn::className()
                                ],
                                'title',
                                [
                                    'attribute' => 'content',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /**
                                         * @var $model \YiiMan\YiiBasics\modules\blog\models\BlogArticles
                                         */
                                        return Yii::$app->functions->limitText($model->content, 100);
                                    }
                                ],
                                'created_at',
                                //'author',
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        /**
                                         * @var $model \YiiMan\YiiBasics\modules\blog\models\BlogArticles
                                         */
                                        switch ($model->status) {
                                            case $model::STATUS_ACTIVE:
                                                return 'Published';
                                                break;
                                            case $model::STATUS_DE_ACTIVE:
                                                return 'Review';
                                                break;
                                        }
                                    },
                                ],

                                [
                                    'class' => 'YiiMan\YiiBasics\lib\ActionColumn',
                                ],
                            ],
                        ]
                    ); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
