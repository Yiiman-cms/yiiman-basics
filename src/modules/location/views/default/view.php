<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\location\models\LocationCity */


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('location', 'ثبت شهر ها'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/location/default/create'
);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('location', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl . '/location/default/update?id=' . $model->id);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('location', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl . '/location/default/delete?id=' . $model->id);


$this->title = Yii::t('location', 'شهر :  ' . $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('location', 'موقعیت جغرافیایی'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>

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
                                'name',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>


        <?php
        if (!empty($model->locationNeighbourhoods0)) {
            ?>


            <div class="card card-nav-tabs">
                <div class="card-body ">
                    <h4 class="text-center">محلات زیر مجموعه</h4>
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <table class="table table-hover">
                                <thead>
                                <?php
                                foreach ($model->locationNeighbourhoods0 as $item) {
                                    /**
                                     * @var $item \YiiMan\YiiBasics\modules\location\models\LocationNeighbourhood
                                     */
                                    ?>
                                    <tr>
                                        <th>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['/location/neighbourhood/view?id=' . $item->id]) ?>"><?= $item->name ?></a>
                                        </th>
                                    </tr>
                                    <?php
                                }
                                ?>

                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <?php
        }
        ?>

    </div>
</div>

