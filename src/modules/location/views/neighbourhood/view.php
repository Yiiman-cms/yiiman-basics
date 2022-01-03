<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\location\models\LocationNeighbourhood */


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('location', 'ثبت محلات'),
    'success',
    null,
    Yii::$app->Options->BackendUrl . '/location/neighbourhood/create'
);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('location', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl . '/location/neighbourhood/update?id=' . $model->id);


\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('location', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl . '/location/neighbourhood/delete?id=' . $model->id);


$this->title = Yii::t('location', 'محله ی :  ' . $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('location', 'موقعیت جغرافیایی'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\YiiMan\YiiBasics\widgets\backLang\backLangWidget::languages($model);

?>
<div class="location-neighbourhood-view">
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
                                    [
                                        'attribute' => 'city',
                                        'value' => function ($model) {
                                            /**
                                             * @var $model \YiiMan\YiiBasics\modules\location\models\LocationNeighbourhood
                                             */
                                            return $model->city0->name;
                                        }
                                    ],
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $anotherNeighbourhoods = \YiiMan\YiiBasics\modules\location\models\LocationNeighbourhood::find()->where(['city' => $model->city])->limit(20)->orderBy('rand()')->all();
            if (!empty($anotherNeighbourhoods)) {
                ?>
                <div class="card card-nav-tabs" style="margin-top: 20px">
                    <div class="card-body ">
                        <h4 class="text-center">محلات دیگر در <?= $model->city0->name ?></h4>
                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <table class="table table-hover">
                                    <tbody>
                                    <?php
                                    foreach ($anotherNeighbourhoods as $item) {
                                        /**
                                         * @var $item \YiiMan\YiiBasics\modules\location\models\LocationNeighbourhood
                                         */
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="<?= Yii::$app->urlManager->createUrl(['/location/neighbourhood/view?id=' . $item->id]) ?>"><?= $item->name ?></a>
                                            </td>
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
                <?php
            }
            ?>

        </div>
    </div>
</div>
