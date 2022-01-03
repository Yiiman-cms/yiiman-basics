<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\lib\Core;
use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \YiiMan\YiiBasics\modules\posttypes\models\Posttypes;

/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\posttypes\models\SearchPosttypes */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $posttype string */

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('posttypes', 'ثبت '),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'pt/create/'.$posttype
);
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages();

$this->title = $searchModel::getConfigs()['items'][$posttype]['labels']['sum'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="posttypes-index">
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
                        'columns'      => include_once __DIR__.'/attributes.php',
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
