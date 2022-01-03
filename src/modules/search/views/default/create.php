<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\search\models\Search */

$this->title = Yii::t('search', 'ثبت جست و جوها');
$this->params['breadcrumbs'][] = ['label' => Yii::t('search', 'جست و جوها'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
