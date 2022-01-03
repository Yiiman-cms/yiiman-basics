<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\slug\models\Slug */

$this->title = Yii::t('slug', 'Add Slug');
$this->params['breadcrumbs'][] = ['label' => Yii::t('slug', 'Slugs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slug-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
