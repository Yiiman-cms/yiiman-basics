<?php
use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\location\models\SearchLocationCity */
/* @var $dataProvider yii\data\ActiveDataProvider */

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('location', 'ثبت شهر ها'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/location/default/create'
);
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages();

$this->title = Yii::t('location', 'شهر ها').' ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="location-city-index">
    <div class="card card-nav-tabs">
        <div class="card-body ">
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

            <div class="row">
                <div class="col-md-12 pull-right">

                        <?php Pjax::begin(); ?>
                                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    


                                            <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
        'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        ['class' => '\YiiMan\YiiBasics\lib\i18n\LanguageColumn'],
                                                            'name',

                        ['class' => 'YiiMan\YiiBasics\lib\ActionColumn'],
                        ],
                        ]); ?>
                                            <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
