<?php
use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\gallery\models\SearchGalleryFkMediasCategories */
/* @var $dataProvider yii\data\ActiveDataProvider */

\system\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('gallery', 'ثبت اتصالات فایل ها'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/gallery-fk-medias-categories/default/create'
);
\system\widgets\backLang\backLangWidget::languages();

$this->title = Yii::t('gallery', 'اتصالات فایل ها').' ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="gallery-fk-medias-categories-index">
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
                                    'media',
            'category',

                        ['class' => 'YiiMan\YiiBasics\lib\ActionColumn'],
                        ],
                        ]); ?>
                                            <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
