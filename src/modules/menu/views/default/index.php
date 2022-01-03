<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use YiiMan\YiiBasics\modules\menu\models\Menu;
use YiiMan\YiiBasics\modules\slug\models\Slug;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\menu\models\SearchMenu */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('menu', 'منوهای سایت').' ';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs($this->render('script/app.js'), $this::POS_END);
\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('Menu', 'ثبت منو'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/menu/default/create'
);
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages();
?>

<div class="menu-index">

    <div class="card card-nav-tabs">
        <div class="card-body ">
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

            <div class="row">
                <div class="col-md-12 pull-right">

                    <?php Pjax::begin(); ?>

                    <?= GridView::widget(
                        [
                            'dataProvider' => $dataProvider,
                            'filterModel'  => $searchModel,
                            'columns'      => [
                                ['class' => 'yii\grid\SerialColumn'],
                                ['class' => \YiiMan\YiiBasics\lib\i18n\LanguageColumn::className()],

                                'title',
                                [
                                    'attribute' => 'slug',
                                    'value'     => function ($model) {
                                        /**
                                         * @var $model \YiiMan\YiiBasics\modules\menu\models\Menu
                                         */
                                        return Slug::getSlug($model);
                                    }
                                ],
                                //'location',
                                //'icon',
                                //'image',
                                [
                                    'attribute' => 'status',
                                    'value'     => function ($model) {
                                        switch ($model->status) {
                                            case Menu::STATUS_PUBLISHED:
                                                return \Yii::t('menu', 'منتشر شده');
                                                break;
                                            case Menu::STATUS_REVIEW:
                                                return \Yii::t('menu', 'بازبینی');
                                                break;
                                        }
                                    },
                                ],
                                //'product',

                                ['class' => 'YiiMan\YiiBasics\lib\ActionColumn'],
                            ],
                        ]
                    ); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
