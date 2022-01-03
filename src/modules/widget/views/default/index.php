<?php

use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel YiiMan\YiiBasics\modules\widget\models\SearchWidget */
/* @var $dataProvider yii\data\ActiveDataProvider */


\system\widgets\backLang\backLangWidget::languages();

$this->title = Yii::t('widget', 'مدیریت ویجت ها ') . ' ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="widget-index">
    <div class="card card-nav-tabs">
        <div class="card-body ">
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

            <div class="row">
                <div class="col-md-12 pull-right">
                    <div class="row">
                        <style>
                            .mapify-img {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 300px !important;
                                height: 420px !important;
                                z-index: -2;
                            }

                            imgframe {
                                border: 1px solid #0000002e;
                                padding: 5px;
                                width: 324px;
                                height: 479px;
                                display: block;
                                border-radius: 5px;
                                margin-bottom: 30px;
                            }

                            .mapify-polygon[status="notempty"] {
                                fill: #177b7b;
                            }
                        </style>
                        <?= \YiiMan\YiiBasics\modules\widget\widgets\MapGenerator::widget() ?>
                        <?php
                        $widgets = \YiiMan\YiiBasics\modules\widget\models\Widget::getLocations();
                        $locations = [];
                        $links = [];
                        $model = \YiiMan\YiiBasics\modules\widget\models\Widget::find()->asArray()->select('shortCode')->all();
                        $idial = [];
                        if (!empty($model)) {
                            $idial = \yii\helpers\ArrayHelper::index($model, 'shortCode');
                        }
                        foreach ($widgets as $location => $label) {
                            $locations[] = $location . '"';
                            $attrs = ' data-desc="برای ویرایش کلیک کنید"';
                            if (!empty($idial[$location])) {
                                $attrs .= ' status="notempty" ';
                            }
                            if (!empty($idial[$location])) {
                                $links[] = Yii::$app->urlManager->createUrl(['/widget/default/update?loc=' . $location]) . '" ' . $attrs;
                            }else{
                                $links[] = Yii::$app->urlManager->createUrl(['/widget/default/create?loc=' . $location]) . '" ' . $attrs;
                            }
                        }

                        foreach ($files as $file) {
                            echo '<div class="col-md-4"> <imgFrame>';
                            $image = file_get_contents(Yii::getAlias('@system') . '/theme/pageSchema/' . $file['name']);
                            $image = str_replace($locations, $links, $image);
                            $image = str_replace('href=""', 'href="#"', $image);
                            echo $image;
                            echo '</imgFrame></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>


        </div>


    </div>
</div>
