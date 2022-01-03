<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\seo\models\SearchSeoFlagContents */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('seo', 'محتوای پرچم ها') . ' ';
$this->params['breadcrumbs'][] = $this->title;
\system\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('seo', 'ثبت کلمه ی راهنما'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/seo/default/create'
);
\system\widgets\backLang\backLangWidget::languages();

?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>راهنمای این بخش</strong>
    <br>
    میتوانید در این بخش کلماتی را تعریف کنید، که نیازمند توضیح یا لینک به یک مقاله هستند.
    این موضوع برای سئوی سایت شما اهمیت ویژه ای دارد.زمانی که کاربر مقاله را باز میکند و آن مقاله شامل هر یک از کلمات
    راهنمایی که در اینجا تعریف میکنید باشد، آن کلمات به صورت لینک به مقاله ی دیگری متصل میشود
</div>
<div class="seo-flag-contents-index">
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
                            ['class' => \YiiMan\YiiBasics\lib\i18n\LanguageColumn::className()],

                            'title',
                            [
                                'attribute' => 'link',
                                'value' => function ($model) {
                                    if (!empty($model->link)) {
                                        return '<a href="' . $model->link . '" target="_blank">' . $model->link . '</a>';
                                    }
                                },
                                'format' => 'raw'
                            ],
                            [
                                'attribute' => 'short_content',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Yii::$app->functions->limitText( strip_tags($model->short_content),50);
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    /**
                                     * @var $model \common\models\Neighbourhoods
                                     */
                                    switch ($model->status) {
                                        case 1:
                                            return 'فعال';
                                            break;
                                        case 0:
                                            return 'غیرفعال';
                                            break;
                                    }
                                },
                            ],
                            ['class' => 'YiiMan\YiiBasics\lib\ActionColumn'],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
