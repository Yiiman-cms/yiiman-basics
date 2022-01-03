<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\widget\models\Widget */

$this->title = Yii::t('widget', 'ویرایش ویجت: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);


\system\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('widget', 'ثبت ویجت'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/widget/default/create'
);

\system\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('widget', 'بازبینی ویجت'),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/widget/default/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('widget', 'ویجت'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('widget', 'ویرایش');
\system\widgets\backLang\backLangWidget::languages($model);
?>
<div class="widget-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
