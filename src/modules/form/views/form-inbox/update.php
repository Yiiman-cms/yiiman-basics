<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\form\models\FormInbox */

$this->title = Yii::t('form', 'ویرایش اطلاعات ثبت شده: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);


\system\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('form', 'ثبت اطلاعات ثبت شده'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/form-inbox/default/create'
);

\system\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('form', 'بازبینی اطلاعات ثبت شده'),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/form-inbox/default/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('form', 'فرم ساز'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('form', 'ویرایش');
\system\widgets\backLang\backLangWidget::languages($model);
?>
<div class="form-inbox-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
