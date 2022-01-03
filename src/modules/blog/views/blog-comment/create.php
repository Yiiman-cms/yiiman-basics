<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\blog\models\BlogComment */

$this->title = Yii::t('blog', 'افزودن دیدگاه');
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'وبلاگ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="blog-comment-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
