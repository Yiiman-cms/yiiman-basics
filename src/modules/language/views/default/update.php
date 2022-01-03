<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\language\models\Language */

$this->title = Yii::t('language', 'ویرایش زبان های سایت: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('language', 'ثبت زبان های سایت'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/language/default/create'
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('language', 'زبان های سایت'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('language', 'ویرایش');

?>
<div class="language-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
