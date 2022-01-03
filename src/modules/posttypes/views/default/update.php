<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\posttypes\models\Posttypes */

$this->title = Yii::t('posttypes', 'ویرایش : ') .' '. \YiiMan\YiiBasics\modules\posttypes\models\Posttypes::getConfigs()['items'][$_GET['posttype']]['labels']['single'].': '. $model->title;


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('posttypes', 'ثبت '),
    'success',
    null,
    Yii::$app->Options->BackendUrl . 'pt/' . $model->postType . '/create'
);

\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'assignment',
    Yii::t('posttypes', 'بازبینی '),
    'info',
    null,
    Yii::$app->Options->BackendUrl . 'pt/view/' . $model->postType . '/' . $model->id
);


$this->params['breadcrumbs'][] = ['label' => \YiiMan\YiiBasics\modules\posttypes\models\Posttypes::getConfigs()['items'][$_GET['posttype']]['labels']['sum'], 'url' => ['/pt/' . $_GET['posttype']]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['/pt/' . $_GET['posttype'] . '/view/' . $model->id]];
$this->params['breadcrumbs'][] = Yii::t('posttypes', 'ویرایش');
\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);
?>
<div class="posttypes-update">

    <?= $this->render(empty($form)?'_form':$form, [
        'model' => $model,
    ]) ?>

</div>
