<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\posttypes\models\Posttypes */

$this->title = Yii::t('posttypes',
        'ثبت ').' '.\YiiMan\YiiBasics\modules\posttypes\models\Posttypes::getConfigs()['items'][$_GET['posttype']]['labels']['single'];
$this->params['breadcrumbs'][] = [
    'label' => \YiiMan\YiiBasics\modules\posttypes\models\Posttypes::getConfigs()['items'][$_GET['posttype']]['labels']['sum'],
    'url'   => ['/pt/'.$_GET['posttype']]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posttypes-create">

    <?= $this->render(empty($form) ? '_form' : $form, [
        'model' => $model,
    ]) ?>

</div>
