<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\language\models\Language */
/**
 * @var array $files
 */

\system\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('language', 'ثبت زبان های سایت'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/language/default/create'
);


\system\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('language', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl . '/language/default/update?id=' . $model->id);


\system\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('language', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl . '/language/default/delete?id=' . $model->id);


$this->title = Yii::t('language', 'زبان های سایت:  ' . $model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('language', 'زبان های سایت'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$url=Yii::$app->urlManager->createUrl(['/language/default/translate']);
$lang=strtolower($model->shortCode);
$js = <<<JS
    $('input').dblclick(function(){
        var el=$(this);
        $.ajax({
        url:'$url',
        method:'get',
        data:
        {
  "source": "auto",
  "target": "$lang",
  "text": $(this).val()
        },
        success:function(res){
            el.val(res);
            el.css('background','#68ff001f');
        }
        });
        

    });
JS;
$this->registerJs( $js, $this::POS_END);

?>
<style>
    #nav_tab {
        background: #ffffff61;
        border-radius: 5px 5px 0 0;
        padding: 11px;
    }

    .tab-pane .table tbody > tr > td:first-child {
        width: 336px;
    }

    ul .active.show, ul .nav-pills > li > a:hover, ul .nav-pills > li > a:focus {
        background-color: #402b2bba !important;
        box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(64, 50, 29, 0.4);
        margin-left: 10px;
        border-radius: 5px !important;
        color: white;
    }

    .nav-pills > li > a {
        line-height: 24px;
        text-transform: uppercase;
        font-size: 12px;
        font-weight: 500;
        min-width: 100px;
        text-align: center;
        color: #555555;
        transition: all .3s;
    }
</style>
<form method="post" action="">
    <button class="btn btn-success" type="submit">ذخیره</button>
    <div class="language-view">
        <div class="container">
            <div class="jumbotron">
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
                                            'attribute' => 'image',
                                            'format' => 'raw',
                                            'value' => function ($model) {
                                                return MediaViewWidget::widget(['attribute' => 'image', 'model' => $model]);
                                            }
                                        ],
                                        'code',
                                        [
                                            'attribute' => 'status',
                                            'value' => function ($model) {
                                                /**
                                                 * @var $model \common\models\Neighbourhoods
                                                 */
                                                switch ($model->status) {
                                                    case 1:
                                                        return 'فعال';
                                                        break;
                                                    case 0:
                                                        return 'غیرفعال';
                                                        break;
                                                }
                                            },
                                        ],
                                        'layout',
                                    ],
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top:20px" class="row">
                    <div class="card card-nav-tabs">
                        <div class="card-body ">
                            <h4 class="text-center"><?= \Yii::t('language', 'ترجمه ی سیستمی') ?></h4>
                            <div class="row">
                                <div class="col-md-12 pull-right">
                                    <div class="col-md-12">

                                        <div class="card-content ">
                                            <ul id="nav_tab" class="nav nav-pills nav-pills-warning">
                                                <?php
                                                $first = true;
                                                foreach ($files as $file) {
                                                    if (empty($file['values'])) {
                                                        continue;
                                                    }
                                                    $style = '';
                                                    if ($file['name'] == 'site') {
                                                        $style = 'style="
background: #32155591;
color: white;" ';
                                                    }
                                                    ?>
                                                    <li>
                                                        <a <?= $style ?> class="<?= $first ? 'active show' : '' ?>"
                                                                         href="#<?= $file['name'] ?>"
                                                                         data-toggle="tab"><?= $file['name'] ?></a>
                                                    </li>
                                                    <?php
                                                    $first = false;
                                                }
                                                ?>
                                            </ul>
                                            <div class="tab-content">

                                                <?php
                                                $isFirst = true;
                                                foreach ($files as $file) {

                                                    if (empty($file['values'])) {
                                                        continue;
                                                    }
                                                    ?>
                                                    <div class="tab-pane <?= $isFirst ? 'active' : '' ?>"
                                                         id="<?= $file['name'] ?>">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th>نام کلید</th>
                                                                    <th>ترجمه</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                foreach ($file['values'] as $key => $item) {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="key"><?= $item['key'] ?></td>
                                                                        <td><input <?= \system\widgets\TippyTooltip\TippyWidget::attribute('برای ترجمه ی ماشینی، دابل کلیک کنید') ?> type="text" class="form-control"
                                                                                   name="<?= $file['name'] ?>[<?= $key ?>]"
                                                                                   value="<?= $item['translate'] ?>">
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $isFirst = false;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
