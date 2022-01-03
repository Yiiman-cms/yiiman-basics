<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\blog\models\BlogComment */

$this->title = Yii::t('blog', 'بروزرسانی دیدگاه ها : ' . $model->name,
    [
        'nameAttribute' => '' . $model->name,
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'وبلاگ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('blog', 'ویرایش');
\system\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('blog', 'ثبت دیدگاه'),
    'success' ,
    null ,
    Yii::$app->Options->BackendUrl . '/blog/default/create'
);

\system\widgets\topMenu\TopMenuWidget::addBtb(
    'assignment',
    Yii::t('blog', 'بازبینی دیدگاه'),
    'info' ,
    null ,
    Yii::$app->Options->BackendUrl . '/blog/default/view?id='.$model->id
);

\system\widgets\backLang\backLangWidget::languages($model);

?>
<div class="blog-comment-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
