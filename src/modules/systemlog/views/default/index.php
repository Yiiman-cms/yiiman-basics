<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\systemlog\models\SearchSystemlog */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $users [] */

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('systemlog', 'پاکسازی'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl . '/systemlog/default/clear'
);
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages();

$this->title = Yii::t('systemlog', 'لاگ های ثبت شده') . ' ';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .log-message {
        padding: 13px;
        direction: ltr;
        text-align: left;
        font-weight: 900;
        width: 100%;
        display: block;
    }

    .kv-expand-icon span {
        color: #165674;
        transform: rotate(180deg);
    }
</style>
<div class="systemlog-index">
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
                            [
                                'class' => 'kartik\grid\ExpandRowColumn',
                                'width' => '50px',
                                'value' => function ($model, $key, $index, $column) {
                                    return GridView::ROW_COLLAPSED;
                                },
                                // show row expanded for even numbered keys
                                'detail' => function ($model) use ($searchModel) {
                                    return Yii::$app->controller->renderPartial('_message', ['model' => $model, 'searchModel' => $searchModel]);
                                },

                                'headerOptions' => ['class' => 'kartik-sheet-style'],
                                'expandOneOnly' => true
                            ],
                            [
                                'attribute' => 'level',
                                'value' => function ($model) {
                                    return \YiiMan\YiiBasics\modules\systemlog\models\DbTarget::getHTMLLevelLabel($model->level);
                                },
                                'format' => 'raw',
                                'filter' => \YiiMan\YiiBasics\modules\systemlog\models\DbTarget::LEVEL_LABELS
                            ],
                            'category',
                            [
                                'attribute' => 'log_time',
                                'filter' => false,
                                'value' => function ($model) {
                                    return Yii::$app->functions->convertdatetime($model->log_time);
                                }
                            ],
                            [
                                'attribute' => 'uid',
                                'filter' => $users,
                                'value' => function ($model) use ($searchModel) {
                                    if ($searchModel->app_name == 'app-backend') {
                                        $user = \YiiMan\YiiBasics\modules\useradmin\models\User::findOne($model->uid);
                                        if (!empty($user)) {
                                            return $user->email;
                                        } else {
                                            return 'حذف شده';
                                        }
                                    } else {
                                        $user = \YiiMan\YiiBasics\modules\user\models\User::findOne($model->uid);
                                        if (!empty($user)) {
                                            return $user->username;
                                        } else {
                                            return '؟';
                                        }
                                    }
                                }
                            ],
                            [
                                'attribute' => 'app_name',
                                'filter' => \YiiMan\YiiBasics\lib\Core::getAppsList(),
                                'value' => function ($model) {
                                    return \YiiMan\YiiBasics\lib\Core::getAppsList()[$model->app_name];
                                }
                            ],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
