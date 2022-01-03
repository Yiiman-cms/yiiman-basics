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
/* @var $searchModel YiiMan\YiiBasics\modules\search\models\SearchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('search', 'ثبت جست و جوها'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/search/default/create'
);
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages();

$this->title = Yii::t('search', 'جست و جوها').' ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="search-index">
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
                            'query',
                            'resultCount',
                            'created_at',
                            'ip',
                            //'result_types:ntext',

                            ['class' => 'YiiMan\YiiBasics\lib\ActionColumn'],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
