<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\form\models\Form */


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('form', 'ثبت فرم ها'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/form/default/create'
);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('form', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl.'/form/default/update?id='.$model->id);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('form', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl.'/form/default/delete?id='.$model->id);


$this->title = Yii::t('form', 'فرم ها:  '.$model->title);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('form', 'فرم ساز'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);
\YiiMan\YiiBasics\modules\form\widgets\FormGeneratorAssets::register($this);

$js = <<<JS

  var escapeEl = document.createElement("textarea");
  var code = document.getElementById("form");
  var formData =
    `{$model->details}`;

  // Grab markup and escape it
  var markup = $("<div/>");
  markup.formRender({ formData });

  // set < code > innerText with escaped markup
  code.innerHTML = markup.formRender("html");

  hljs.highlightBlock(code);

JS;
$this->registerJs($js, \YiiMan\YiiBasics\lib\View::POS_END);
?>
<div class="form-view">
    <div class="container">
        <div class="jumbotron">
            <div class="viewLanguagebox">
                زبان های ست شده:
                <?= (new \YiiMan\YiiBasics\lib\i18n\LanguageColumn())->renderDataCell($model, 0, 0) ?>
            </div>
            <div class="card card-nav-tabs">
                <div class="card-body ">
                    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'title',
                                    [
                                        'attribute' => 'details',
                                        'value'     => function ($model) {
                                            echo '<div id="form">

                            </div>';
                                        }
                                    ],
                                ],
                            ]) ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
