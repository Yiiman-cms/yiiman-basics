<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\language\models\SearchLanguage */
/* @var $dataProvider yii\data\ActiveDataProvider */

\system\widgets\backLang\backLangWidget::languages();
\system\widgets\topMenu\TopMenuWidget::addBtb('add',Yii::t('language','ثبت زبان'),'success',null,Yii::$app->Options->BackendUrl . '/language/default/create');


$this->title = Yii::t('language', 'زبان های سایت') . ' ';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
if (!\YiiMan\YiiBasics\lib\Core::$enabledLanguage){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>سیستم چند زبانگی خاموش است!</strong> توجه داشته باشید، سیستم چند زبانگی در این پروژه خاموش است، در این حالت شما فقط میتوانید ترجمه های مربوط به پنل مدیریت را تغییر دهید
    </div>
    <?php
}
?>
<div class="language-index">
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

                            'title',
                            [
                                'attribute' => 'image',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return MediaViewWidget::widget(['attribute' => 'image', 'model' => $model, 'count' => 1]);
                                }
                            ],
                            'code',
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'value' => function ($model) {

                                    switch ($model->status) {
                                        case $model::STATUS_ACTIVE:
                                            return '<span style="color:green">انتشار یافته</span>';
                                            break;
                                        case $model::STATUS_DE_ACTIVE:
                                            return '<span
                                                style="color: red">بازبینی</span>';
                                            break;
                                    }
                                },
                            ],
                            //'layout',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
