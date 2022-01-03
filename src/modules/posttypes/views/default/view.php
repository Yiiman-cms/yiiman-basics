<?php

use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use YiiMan\YiiBasics\modules\posttypes\models\Posttypes;
use YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields;
use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\posttypes\models\Posttypes */
/* @var $form yii\widgets\ActiveForm */

$posttype = $_GET['posttype'];
$multiples = [];
$cards = [];
$sideCards = [];

$html = '';

if (!empty($model::getConfigs()['items'][$posttype]['fields'])) {
    foreach ($model::getConfigs()['items'][$posttype]['fields'] as $name => $column) {
        if (empty($column['col']) && $column['type'] != Posttypes::INPUT_CARD) {
            $column['col'] = 6;
        }

        $type = $model::getConfigs()['items'][$posttype]['fields'][$name]['type'];

        $html .= Posttypes::renderView($model, $name, $column, $type, $multiples, $cards, $sideCards);

    }
}

$posttype = $model->postType;
\system\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('posttypes', 'ثبت '),
    'success',
    null,
    Yii::$app->Options->BackendUrl . 'pt/create/' . $posttype
);


\system\widgets\topMenu\TopMenuWidget::addBtb(
    'edit',
    Yii::t('posttypes', 'ویرایش این مورد'),
    'info',
    null,
    Yii::$app->Options->BackendUrl . 'pt/update/' . $posttype . '/' . $model->id);


\system\widgets\topMenu\TopMenuWidget::addBtb(
    'delete',
    Yii::t('posttypes', 'حذف این مورد'),
    'danger',
    null,
    Yii::$app->Options->BackendUrl . 'pt/delete/' . $posttype . '/' . $model->id);


$this->title = Yii::t('posttypes', 'بازبینی:  ') . $model->title;
$this->params['breadcrumbs'][] = ['label' => \YiiMan\YiiBasics\modules\posttypes\models\Posttypes::getConfigs()['items'][$_GET['posttype']]['labels']['sum'], 'url' => ['/pt/' . $_GET['posttype']]];
$this->params['breadcrumbs'][] = $this->title;

\system\widgets\backLang\backLangWidget::languages($model);

?>
<style>
    .card img {
        width: 100%;
        border-radius: 5px;
        box-shadow: 0 5px 15px -8px rgba(0, 0, 0, .24), 0 8px 10px -5px rgba(0, 0, 0, .2);
    }
    .navbar.bg-dark {
        color: #fff;
        background-color: #212121 !important;
        box-shadow: 0 4px 20px 0 rgba(0,0,0,.14),0 7px 12px -5px rgba(33,33,33,.46);
        padding: 10px;
        border-radius: 5px;
        margin: 18px 0;
        text-align: center;
    }
</style>
<div class="posttypes-view">
    <div class="container">
        <div class="jumbotron">
            <?php
            if (\YiiMan\YiiBasics\lib\Core::$enabledLanguage) {
                ?>
                <div class="viewLanguagebox">
                    زبان های ست شده:
                    <?= (new \YiiMan\YiiBasics\lib\i18n\LanguageColumn())->renderDataCell($model, 0, 0) ?>
                </div>
                <?php
            }
            ?>

            <div class="row">
                <div class="col-md-3">

                    <?php
                    if ($model::getConfigs()['items'][$posttype]['options']['hasPicture']) {
                        ?>
                        <div class="row">
                            <div class="card card-nav-tabs">
                                <div class="card-body ">
                                    <h4 class="text-center">تصاویر</h4>
                                    <div class="row">
                                        <div class="col-md-12 pull-right">
                                            <?php
                                            if ($model->defaultImageCount() > 1) {
                                                foreach ($model->getdefaultImageLinks('500*500') as $link) {
                                                    ?>

                                                    <img src="<?= $link ?>" alt="">

                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <img src="<?= $model->getdefaultImageLink('500*500') ?>" alt="">
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php
                    }

                    if (!empty($sideCards)) {
                    foreach ($sideCards

                    as $card) {
                    if (empty($card['col'])) {
                    ?>
                    <div class="row" style="margin-top: 20px">
                        <?php
                        }else{
                        ?>
                        <div class="col-md-<?= $card['col'] ?>" style="margin-top: 20px">
                            <?php
                            }
                            ?>


                            <div class="card card-nav-tabs">
                                <div class="card-body ">
                                    <h4 class="text-center"><?= $card['label'] ?></h4>
                                    <div class="row">
                                        <div class="col-md-12 pull-right">
                                            <?= $card['items'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        }

                        }
                        ?>
                    </div>


                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-nav-tabs card-rtl">
                                    <div class="card-body ">
                                        <div class="col-md-12">
                                            <h4 class="text-center">
                                                مشخصات <?= $model::getConfigs()['items'][$posttype]['labels']['single'] ?></h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4 class="navbar bg-dark"><?= $model->title ?></h4>
                                                </div>

                                                <?= $html ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (!empty($multiples)) {
                            foreach ($multiples as $item) {
                                ?>
                                <div class="row" style="margin-top: 20px">
                                    <div class="col-md-12">
                                        <div class="card card-nav-tabs">
                                            <div class="card-body ">
                                                <h4 class="text-center"><?= $item['label'] ?></h4>
                                                <div class="row">
                                                    <div class="col-md-12 pull-right">
                                                        <?= $item['field'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }

                        if (!empty($cards)) {
                        foreach ($cards

                        as $card) {

                        ?>
                        <?php
                        if (empty($card['col'])) {
                        ?>
                        <div class="row" style="margin-top: 20px">
                            <?php
                            } else {
                            ?>
                            <div class="col-md-<?= $card['col'] ?>">
                                <?php
                                }
                                ?>

                                <div class="col-md-12">
                                    <div class="card card-nav-tabs">
                                        <div class="card-body ">
                                            <h4 class="text-center"><?= $card['label'] ?></h4>
                                            <div class="row">
                                                <div class="col-md-12 pull-right">
                                                    <?= $card['items'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }

                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
