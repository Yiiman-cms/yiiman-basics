<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/* @var $this \yii\web\View */
/* @var $content string */
$image = Yii::$app->Options->bgImage.'?ver='.Yii::$app->Options->assetVersion;

use YiiMan\YiiBasics\assets\dashboard\MaterialDashboardProAsset;
use YiiMan\YiiBasics\lib\i18n\Layout;
use yii\helpers\Html;

MaterialDashboardProAsset::register($this);
//$settings_site=\common\models\SettingsSite::findOne(1);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" layout="<?= Layout::run() ?>">

<head>
    <meta charset="utf-8"/>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="width=device-width" name="viewport"/>
    <?= Html::csrfMetaTags() ?>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet'
          type='text/css'>
    <title></title>
    <?php $this->head() ?>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/minus.png">
</head>
<body class="off-canvas-sidebar image-body text-light">
<style>
    <
    style >
    #loginform-email, #loginform-password {
        text-align: left;
        direction: ltr;
    }

    .page-header {
        height: 100vh;
        background-position: center center;
        background-size: cover;
        margin: 0;
        padding-top: 12%;
        border: 0;
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px;
        top: 0;
    }

    .container {
        /* margin-top: 24%; */
        /* transform: translateY(-50%); */
        display: block;
    }

    .col-lg-4.col-md-6.ml-auto.mr-auto {
        margin-left: auto;
        margin-right: auto;
        float: none;
    }

    .card-login .card-header {
        margin: -40px 20px 15px;
        padding: 20px;
        border-radius: 5px;
    }

    .card-title {
        text-align: center;
    }

    .card[class*="bg-"], .card[class*="bg-"] .card-title, .card[class*="bg-"] .card-title a, .card[class*="bg-"] .icon i, .card [class*="header-"], .card [class*="header-"] .card-title, .card [class*="header-"] .card-title a, .card [class*="header-"] .icon i {
        color: #fff;
    }

    .card .card-header-primary {
        box-shadow: 0 5px 20px 0 rgba(0, 0, 0, .2), 0 13px 24px -11px rgba(156, 39, 176, .6);
    }

    .card.bg-primary, .card .card-header-primary, .card.card-rotate.bg-primary .back, .card.card-rotate.bg-primary .front {
        background: linear-gradient(60deg, #ab47bc, #7b1fa2);
    }

    .btn.btn-primary {
        margin: auto;
        display: block;
    }
</style>
<?php $this->beginBody() ?>
<!-- Preloader -->
<!--<div id="preloader">-->
<!--    <div id="status">&nbsp;</div>-->
<!--</div>-->

<div class="section section-signup page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                <div class="card card-login">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  END OF PAPER WRAP -->
<div class="panel-background-image"
     style="background-image: url(<?= $image ?>) ">

</div>
<?php $this->endBody() ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<script type="text/javascript">
    $().ready(function () {
        demo.checkFullPageBackgroundImage();

        setTimeout(function () {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>

</body>

</html>
<?php $this->endPage() ?>
