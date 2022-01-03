<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \YiiMan\YiiBasics\modules\menumodern\models\Menu */

$this->title =  Yii::t('menumodern','ایجاد').' '.Yii::t('menumodern','منو');
$this->params['breadcrumbs'][] = ['label' => 'منو', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
