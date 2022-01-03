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
/* @var $model YiiMan\YiiBasics\modules\ticket\models\TicketDepartmentUsers */


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('ticket', 'ثبت '),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/ticket-department-users/default/create'
);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('ticket', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl.'/ticket-department-users/default/update?id='.$model->id);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('ticket', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl.'/ticket-department-users/default/delete?id='.$model->id);


$this->title = Yii::t('ticket', ':  '.$model->id);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('ticket', 'تیکت'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>
<div class="ticket-department-users-view">
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
                                    'department',
                                    'uid',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
