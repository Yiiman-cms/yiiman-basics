<?php

use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use YiiMan\YiiBasics\modules\posttypes\models\Posttypes;
use YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields;

/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\posttypes\models\Posttypes */
/* @var $form yii\widgets\ActiveForm */

$posttype = $_GET['posttype'];
$multiples = [];
$cards = [];
$sideCards = [];

$html = '';
$form = ActiveForm::begin();
if (!empty($model::getConfigs()['items'][$posttype]['fields'])) {

    foreach ($model::getConfigs()['items'][$posttype]['fields'] as $name => $column) {
        if (empty($column['col']) && $column['type'] != Posttypes::INPUT_CARD) {
            $column['col'] = 6;
        }

        $type = $model::getConfigs()['items'][$posttype]['fields'][$name]['type'];

        $html .= Posttypes::render($model, $name, $column, $form, $type, $multiples, $cards, $sideCards);

    }
}


?>
<style>
    .btn.btn-success.add-btn, .btn.btn-danger.remove-btn, .js-input-clone {
        width: 30px;
        min-width: 9px;
        padding: 7px;
        height: 30px;
        padding-left: 8px;
        padding-top: 6px;
        margin-top: -2px;
    }

    /*.bmd-form-group .form-control {*/
    /*    height: 30px;*/
    /*}*/
</style>

<!--//multiinput table Style-->
<style>
    /* Table Styles */

    .multiple-input {
        margin: 10px 70px 70px;
        box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
    }

    .multiple-input-list {
        border-radius: 5px;
        font-size: 12px;
        font-weight: normal;
        border: none;
        border-collapse: collapse;
        width: 100%;
        max-width: 100%;
        white-space: nowrap;
        background-color: white;
    }

    .multiple-input-list td, .multiple-input-list th {
        text-align: center;
        padding: 8px;
    }

    .multiple-input-list td {
        border-right: 1px solid #f8f8f8;
        font-size: 12px;
    }

    .multiple-input-list thead th {
        color: #ffffff;
        background: #324960;
    }

    td, td a {
        color: black !important;
    }

    .multiple-input-list thead th:nth-child(odd) {
        color: #ffffff;
        background: #324960;
    }

    .multiple-input-list tr:nth-child(even) {
        background: #F8F8F8;
    }

    /* Responsive */

    @media (max-width: 767px) {
        .multiple-input-list {
            display: block;
            width: 100%;
        }

        .table-wrapper:before {
            content: "Scroll horizontally >";
            display: block;
            text-align: right;
            font-size: 11px;
            color: white;
            padding: 0 0 10px;
        }

        .multiple-input-list thead, .multiple-input-list tbody, .multiple-input-list thead th {
            display: block;
        }

        .multiple-input-list thead th:last-child {
            border-bottom: none;
        }

        .multiple-input-list thead {
            float: left;
        }

        .multiple-input-list tbody {
            width: auto;
            position: relative;
            overflow-x: auto;
        }

        .multiple-input-list td, .multiple-input-list th {
            padding: 20px .625em .625em .625em;
            height: 60px;
            vertical-align: middle;
            box-sizing: border-box;
            overflow-x: hidden;
            overflow-y: auto;
            width: 120px;
            font-size: 13px;
            text-overflow: ellipsis;
        }

        .multiple-input-list thead th {
            text-align: left;
            border-bottom: 1px solid #f7f7f9;
        }

        .multiple-input-list tbody tr {
            display: table-cell;
        }

        .multiple-input-list tbody tr:nth-child(odd) {
            background: none;
        }

        .multiple-input-list tr:nth-child(even) {
            background: transparent;
        }

        .multiple-input-list tr td:nth-child(odd) {
            background: #F8F8F8;
            border-right: 1px solid #E6E4E4;
        }

        .multiple-input-list tr td:nth-child(even) {
            border-right: 1px solid #E6E4E4;
        }

        .multiple-input-list tbody td {
            display: block;
            text-align: center;
        }

    }

    .form-group input {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    }

    .multiple-input-list__btn .fa {
        color: white !important;
    }

    .multiple-input {
        margin: 0;
        box-shadow: 0px 9px 17px rgba(0, 0, 0, 0.2);
        border-radius: 9px;
    }

    .center-block {
        display: block;
        margin: auto;
    }

    .u-g {
        color: #3d0d4a;
    }

</style>
<div class="posttypes-form">

    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="card card-nav-tabs">
                    <div class="card-body ">
                        <h4 class="text-center">وضعیت انتشار </h4>
                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <?= $form->field($model, 'status')->widget(
                                    \kartik\select2\Select2::className(),
                                    [
                                        'data' =>
                                            [
                                                $model::STATUS_ACTIVE => 'منتشر شده',
                                                $model::STATUS_DE_ACTIVE => 'در حال بازبینی',

                                            ],
                                        'options' => ['dir' => 'rtl'],
                                        'pluginOptions' => ['dir' => 'rtl'],
                                        'pluginEvents' => [
                                            "change" => "function() {  }",
                                            "select2:opening" => "function() {  }",
                                            "select2:open" => "function() {  }",
                                            "select2:closing" => "function() {  }",
                                            "select2:close" => "function() {  }",
                                            "select2:selecting" => "function() {  }",
                                            "select2:select" => "function() {  }",
                                            "select2:unselecting" => "function() {  }",
                                            "select2:unselect" => "function() {  }"
                                        ]
                                    ]
                                ) ?>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($model::getConfigs()['items'][$posttype]['options']['hasPicture']) {
                $model->image_input_widget($form, 'درج تصویر', true);
            }

            if (!empty($sideCards)) {
                foreach ($sideCards as $card) {
                    if (empty($card['col'])) {
                        echo '<div class="row" style="margin-top: 20px">';
                        ?>

                        <?php
                    } else {
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
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
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
<?php ActiveForm::end(); ?>
