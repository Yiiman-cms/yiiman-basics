<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\search\models\Search */

$this->title = Yii::t('search', 'ویرایش جست و جوها: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'add',
Yii::t('search', 'ثبت جست و جوها'),
'success' ,
null ,
Yii::$app->Options->BackendUrl . '/search/default/create'
);

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
'assignment',
Yii::t('search', 'بازبینی جست و جوها'),
'info' ,
null ,
Yii::$app->Options->BackendUrl . '/search/default/view?id='.$model->id
);



$this->params['breadcrumbs'][] = ['label' => Yii::t('search', 'جست و جوها'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('search', 'ویرایش');
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);
?>
<div class="search-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
