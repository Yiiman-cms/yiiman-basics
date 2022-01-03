<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\product\models\ProductCategory */

$this->title = Yii::t('product', 'ویرایش گروه محصول: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);


\system\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('product', 'ثبت گروه محصول'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/product/product-category/create'
);

\system\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('product', 'بازبینی گروه محصول'),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/product/product-category/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('product', 'محصولات'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('product', 'ویرایش');
\system\widgets\backLang\backLangWidget::languages($model);
?>
<div class="product-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
