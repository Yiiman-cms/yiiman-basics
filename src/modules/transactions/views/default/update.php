<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\transactions\models\Transactions */

$this->title = Yii::t('transactions', 'ویرایش تراکنش ها: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('transactions', 'ثبت تراکنش ها'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/transactions/default/create'
);

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('transactions', 'بازبینی تراکنش ها'),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/transactions/default/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('transactions', 'مالی'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('transactions', 'ویرایش');
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);
?>
<div class="transactions-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
