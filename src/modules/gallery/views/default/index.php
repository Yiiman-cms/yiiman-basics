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
/* @var $searchModel YiiMan\YiiBasics\modules\gallery\models\SearchGalleryCategories */
/* @var $dataProvider yii\data\ActiveDataProvider */

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('gallery', 'ثبت پوشه ها'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/gallery/default/create'
);
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages();

$this->title = Yii::t('gallery', 'پوشه ها').' ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="gallery-categories-index">
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
                        'columns'      => [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['class' => '\YiiMan\YiiBasics\lib\i18n\LanguageColumn'],
                            'title',
                            'description:ntext',
                            [
                                'attribute' => 'image',
                                'format'    => 'raw',
                                'value'     => function ($model) {
                                    return MediaViewWidget::widget([
                                        'attribute' => 'image',
                                        'model'     => $model,
                                        'count'     => 1
                                    ]);
                                }
                            ],
                            'parent',

                            ['class' => 'YiiMan\YiiBasics\lib\ActionColumn'],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
