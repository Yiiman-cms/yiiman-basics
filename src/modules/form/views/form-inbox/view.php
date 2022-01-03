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
/* @var $model YiiMan\YiiBasics\modules\form\models\FormInbox */
/* @var $dataArray [] */


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('form', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl.'/form-inbox/default/delete?id='.$model->id);


$this->title = Yii::t('form', 'اطلاعات ثبت شده:  '.$model->title);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('form', 'فرم ساز'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>
<div class="row">
    <div class="col-md-12">
        <div class="form-inbox-view">
            <div class="jumbotron">
                <div class="viewLanguagebox">
                    زبان های ست شده:
                    <?= (new \YiiMan\YiiBasics\lib\i18n\LanguageColumn())->renderDataCell($model, 0, 0) ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-nav-tabs">
                            <div class="card-body ">
                                <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
                                <div class="row">
                                    <div class="col-md-12 pull-right">
                                        <?= DetailView::widget([
                                            'model' => $model,
                                            'attributes' => [
                                                'ip',
                                                [
                                                    'attribute' => 'ip',
                                                    'value'     => function ($model) {
                                                        try {
                                                            $details = json_decode(file_get_contents("https://api.ipdata.co/".$model->ip."?api-key=test"));
                                                            echo '<pre>';
                                                            var_dump($details);
                                                            die();
                                                            if (!empty($details)) {

                                                                return $details->country.'--'.$details->city;
                                                            }
                                                        } catch (\Exception $e) {
                                                        }
                                                    },
                                                    'label'     => \Yii::t('form', 'مکان کاربر')
                                                ],
                                                [
                                                    'attribute' => 'created_at',
                                                    'value'     => function ($model) {
                                                        return Yii::$app->functions->convertdatetime($model->created_at);
                                                    }
                                                ],
                                                [
                                                    'attribute' => 'status',
                                                    'value'     => function ($model) {
                                                        /**
                                                         * @var $model \YiiMan\YiiBasics\modules\form\models\FormInbox
                                                         */
                                                        switch ($model->status) {
                                                            case 1:
                                                                return 'دیده شده';
                                                                break;
                                                            case 0:
                                                                return 'دیده نشده';
                                                                break;
                                                        }
                                                    },
                                                ],

                                                [
                                                    'attribute' => 'form',
                                                    'value'     => function ($model) {
                                                        /**
                                                         * @var $model \YiiMan\YiiBasics\modules\form\models\FormInbox
                                                         */
                                                        return $model->form0->title;
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
                <div class="row" style="margin-top: 20px">
                    <div class="col-md-12">
                        <div class="card card-nav-tabs">
                            <div class="card-body ">
                                <h4 class="text-center"><?= \Yii::t('form', 'اطلاعات ارسالی کاربر') ?></h4>
                                <div class="row">
                                    <div class="col-md-12 pull-right">
                                        <table class="table table-hover">
                                            <tbody>
                                            <?php
                                            foreach ($dataArray as $label => $value) {

                                                ?>
                                                <tr>
                                                    <td style="font-weight: 900"><?= $label ?></td>
                                                    <td><?= $value ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                            </tbody>
                                        </table>
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

