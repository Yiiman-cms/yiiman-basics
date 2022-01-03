<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $departments \YiiMan\YiiBasics\modules\ticket\models\TicketDepartments[] */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'تخصیص کاربران ادمین به دپارتمان ها';
\system\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('ticket', 'ثبت '),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/ticket/ticket-department-users/create'
);
\system\widgets\backLang\backLangWidget::languages();

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ticket-department-users-index">
    <div class="card card-nav-tabs">
        <div class="card-body ">
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
            <div class="alert alert-info">
                <p>
                    در این بخش مشخص کنید هر کدام از دپارتمان ها به کدام کاربران ادمین اختصاص می یابد؟
                </p>
                <p>
                    با تخصیص کاربران، هر کاربر تنها پیام های دپارتمان خود را مشاهده میکند.
                </p>
            </div>
            <div class="row">
                <div class="col-md-12 pull-right">

                    <?php Pjax::begin(); ?>

                    <?php Pjax::end(); ?>
                </div>
            </div>


        </div>


    </div>
</div>
