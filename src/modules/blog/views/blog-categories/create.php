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
/* @var $model YiiMan\YiiBasics\modules\blog\models\BlogArticles */

$this->title = Yii::t('blog', 'افزودن دسته بندی');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('blog', 'وبلاگ'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('blog', 'دسته بندی ها'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="blog-articles-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
