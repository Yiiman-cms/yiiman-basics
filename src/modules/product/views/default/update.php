<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\product\models\Product */

$this->title = Yii::t('product', 'ویرایش محصول: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('product', 'ثبت محصول'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/product/default/create'
);

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('product', 'بازبینی محصول'),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/product/default/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('product', 'محصولات'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('product', 'ویرایش');
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);
?>
<div class="product-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
