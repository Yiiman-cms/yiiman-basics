<?php
use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\product\models\Product */


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('product', 'ثبت محصول'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/product/default/create'
);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'edit',
Yii::t('product', 'ویرایش این مورد'),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/product/default/update?id='.$model->id);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'delete',
Yii::t('product', 'حذف این مورد'),
'danger' ,
null ,
Yii::$app->Options->BackendUrl . '/product/default/delete?id='.$model->id);


$this->title = Yii::t('product','محصول:  '.$model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('product', 'محصولات'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>
<div class="product-view">
    <div class="container">
        <div class="jumbotron">
            <div class="viewLanguagebox">
                زبان های ست شده:
                <?= (new \YiiMan\YiiBasics\lib\i18n\LanguageColumn())->renderDataCell($model,0,0) ?>
            </div>
            <div class="card card-nav-tabs">
                <div class="card-body ">
                    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                        'hash',
            'title',
            'description:ntext',
                                            [
                                            'attribute' => 'status' ,
                                            'value'   => function ( $model ) {
                                            /**
                                            * @var $model \common\models\Neighbourhoods
                                            */
                                            switch ( $model->status ) {
                                            case 1:
                                            return 'فعال';
                                            break;
                                            case 0:
                                            return 'غیرفعال';
                                            break;
                                            }
                                            },
                                            ],
                                                        'code',
            'unit',
            'weight',
            'discount',
            'hit',
            'sold',
            'created_at',
            'updated_at',
            'json_data:ntext',
                            ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
