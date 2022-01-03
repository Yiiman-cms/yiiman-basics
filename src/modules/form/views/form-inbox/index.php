<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\form\models\SearchFormInbox */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $form \YiiMan\YiiBasics\modules\form\models\Form */


\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages();

$this->title = $form->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-inbox-index">
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
                            'ip',
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    /**
                                     * @var $model \YiiMan\YiiBasics\modules\form\models\FormInbox
                                     */
                                    switch ($model->status) {

                                        case $model::STATUS_SEEN:
                                            return '<span style="color:green">دیده شده</span>';
                                            break;
                                        case $model::STATUS_NOT_SEEN:
                                            return '<span
                                                style="color: orange">دیده نشده</span>';
                                            break;
                                    }
                                },
                            ],
                            [
                                'attribute' => 'created_at',
                                'value' => function ($model) {
                                    return Yii::$app->functions->convertdatetime($model->created_at);
                                }
                            ],
                            //'title',
                            //'form',

                            ['class' => 'YiiMan\YiiBasics\lib\ActionColumn','template'=>'{view} {delete}'],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
