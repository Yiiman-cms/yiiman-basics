<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use common\models\Category;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('menumodern', 'مدیریت منوها');
$this->params['breadcrumbs'][] = $this->title;
$provider = new \YiiMan\YiiBasics\modules\menumodern\models\Provider();
$languageMenu = $provider->languageMenu();
$topMenu = $provider->topMenu();
$menu = $provider->getMenu();


/* < load JavaScript From Frontend > */
{
    $this->registerJs(
        file_get_contents(realpath(__DIR__.'/../../assets/app.js')),
        $this::POS_END
    );
    $this->registerJs(
        file_get_contents(realpath(__DIR__.'/../../assets/index.js')),
        $this::POS_END
    );
    $this->registerJs(
        file_get_contents(__DIR__.'/../../assets/jquery.form.js'),
        $this::POS_END
    );
    $this->registerJs(
        file_get_contents(__DIR__.'/../../assets/sweetalert.js'),
        $this::POS_END
    );


}
/* </ load JavaScript From Frontend > */

?>

<style>

    /*MEGAMENU*/

    .open {
        display: block;
    }

    .dropdown-item:focus {
        border: none;
    }

    .prnt .dropdown-menu a {
        border: none !important;
    }

    .prnt .dropdown-menu a {
        margin-bottom: 5px;
        margin-top: 5px;
        display: block;
    }

    .prnt .dropdown-menu {
        height: auto;
    }

    .nav.flex-column.nav-pills.mega {
        display: flex;
        flex-direction: column;
        width: auto;
        background: hsl(40, 12%, 95.1%);
        height: 99vw;
        border-radius: 0 5px 5px 0;
    }

    .tab-content li a {
        white-space: nowrap;
        text-overflow: ellipsis !important;
    }

    #megatabs .nav-link:hover {
        background: white;
        border-radius: 0px 4px 4px 0px;
        border: none;
        color: hsl(0, 74.4%, 61.8%) !important;
    }

    #megatabs .mega-dropdown ul a {
        line-height: 12px !important;
        color: hsla(0, 0%, 0%, 0.72) !important;
        font-size: smaller;
    }

    .mega-dropdown ul a i {
        margin-right: 5px;
        font-weight: bold;
        color: hsla(0, 0%, 0%, 0.43);
    }

    .mega-dropdown ul a {
        line-height: 12px !important;
        font-size: smaller;
    }

    #megatabs .nav-link {
        margin-right: 20px !important;
        padding-bottom: 12px !important;
        padding-top: 12px !important;
        margin-bottom: 0px;
        margin-top: 8px;
        border: none !important;
        color: hsla(0, 0%, 0%, 0.77) !important;
        font-weight: 400;
    }


    .mega-dropdown ul a.parent {
        font-weight: 400;
    }

    .mega-dropdown .tab-pane {
        padding-right: 0;
    }

    .mega-dropdown .rb {
        border-right: none !important;
    }

    #megamenuHeader:hover {
        background: white;
        border-bottom: hsl(0, 94.5%, 49.8%) solid 3px;
    }

    #megamenuHeader:active {
        background: white;
        border-bottom: hsl(0, 86.5%, 49.2%) solid 2px;
    }

    #megamenuHeader {
        background: white;
        border-bottom: red solid 2px;
    }

    .w100p.parent:hover {
        border-bottom-color: white;
        color: hsl(0, 77.1%, 42.7%) !important;
    }

    #megatabs .nav-link.active {
        background: white;
        border-radius: 0px 4px 4px 0px;
        border: none;
        color: hsl(0, 74.4%, 61.8%) !important;
        box-shadow: none;
    }

    .dropdown-menu [data-toggle="pill"] i {
        margin-left: 10px;
    }

    .dropdown-menu.child-parent {
        float: left;
        /*display: block;*/
        position: absolute;
        right: 100%;
        /*top: 27%;*/
    }

    .dropdown-menu > a.dropdown-item:hover {
        color: #fff;
        text-decoration: none;
        background-color: #7297b7;
    }


    .addRightChild {
        background: hsla(0, 0%, 0%, 0.14);
        border-radius: 50px;
        padding: 6px 5px 4px 0px;
    }

    .addRightChild:hover i {
        color: white;
    }

    .addRightChild i {
        color: white;
    }

    .addRight {
        height: 10px;
        text-align: center;
        cursor: pointer;
        background: hsla(0, 0%, 0%, 0.2);
        width: 20px;
        margin-left: auto;
        border-radius: 50px;
        padding-top: 6px;
        padding-bottom: 19px;
        padding-left: 23px;
        padding-right: 2px;

        margin-right: auto;
        margin-top: 22px;
    }

    .col-md-9 .addRight {
        margin: auto;
        display: block;
        margin-top: 27px;

        height: 60px;
        width: 60px;
        padding-top: 21px;
        padding-right: 17px;
        font-size: large;
    }

    .addRight:hover i {
        color: white;
    }

    .modal-lg {
        width: 100%;
        height: 100%;
        top: 0;
        margin: 0;
    }

    .floatBtn {
        color: hsl(0, 0%, 100%);
        background-color: hsl(122.4, 39.4%, 49.2%) !important;
        border-color: hsl(122.4, 39.4%, 49.2%) !important;
        box-shadow: 0 2px 2px 0 hsla(122.4, 39.4%, 49.2%, 0.14), 0 3px 1px -2px hsla(122.4, 39.4%, 49.2%, 0.2), 0 1px 5px 0 hsla(122.4, 39.4%, 49.2%, 0.12) !important;
    }

    .floatBtn {
        box-shadow: 0 14px 26px -12px hsla(122.4, 39.4%, 49.2%, 0.42), 0 4px 23px 0 hsla(0, 0%, 0%, 0.12), 0 8px 10px -5px hsla(122.4, 39.4%, 49.2%, 0.2);
        color: hsl(0, 0%, 100%);
        background-color: hsl(122.6, 39.6%, 46.1%) !important;
        border-color: hsl(122.4, 39.7%, 37.1%) !important;

    }

    #modal {
        padding: 0 !important;
    }

    #page-wrapper {
        height: 1000px;
    }

    .deleteElement, .editElement {
        margin-right: 10px;
        font-size: larger;
        cursor: pointer;
        padding-left: 7px;
        padding-right: 6px;
        padding-top: 3px;
        transition: ease 0.5s;
    }

    .editElement {
        color: green;
    }

    .deleteElement {
        color: red;
    }

    .deleteElement:hover {
        background: hsla(0, 89.8%, 46.1%, 0.51);
        border-radius: 50px;
        color: white;
        transition: ease 0.5s;
    }

    .deleteElement:hover i {
        color: white;
    }

    .col-md-9 a {
        color: hsla(0, 0%, 0%, 0.73);
    }

    .col-md-9 li {
        margin-bottom: 18px;
        list-style: disc;
        color: hsl(60, 26.3%, 77.6%);
        padding-top: 5px;
    }

    .col-md-3 .editElement {
        padding-bottom: 6px;
        padding-top: 10px;
        padding-right: 6px;
        padding-left: 4px;
    }

    .col-md-9 .editElement {
        padding-left: 10px;
        padding-bottom: 10px;
        padding-top: 10px;
        padding-right: 3px;
    }

    .col-md-9 .deleteElement {
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 6px;
        padding-bottom: 8px;
    }

    .editElement:hover {
        background: green;
        border-radius: 50px;
        color: white;
        transition: ease 0.5s;
    }

    .editElement:hover i {

        color: white;
        transition: ease 0.5s;
    }

    .fa.fa-edit:hover {
        color: white !important;
    }

    .deleteElement .fa.fa-trash {
        text-align: center;
        margin: auto;
    }

    .dropdown-menu [data-toggle="pill"] i:hover {
        color: white;
    }


    /*yiimnan changes*/

    .nav.navbar-nav.ui-draggable.ui-draggable-handle {
        background: white;
        border-radius: 5px;
        box-shadow: 0 5px 15px -8px rgba(0, 0, 0, .24), 0 8px 10px -5px rgba(0, 0, 0, .2);
        max-width: 60vw;
        float: right;
        padding-right: 0;
    }

    .ui-draggable.navbar-nav > li {
        float: right;
        max-width: 230px;
        max-height: 50px;
    }

    .description-box {
        background: #fffffff0;
        padding: 10px;
        border-radius: 5px;
        margin-top: 20px;
        box-shadow: 0 5px 15px -8px rgba(0, 0, 0, .24), 0 8px 10px -5px rgba(0, 0, 0, .2);
    }

    .dropdown-menu.mega-dropdown-menu.shadowTwo.pb0 {
        padding-top: 0 !important;
        width: calc(100vw - 30vw) !important;
        border-radius: 8px !important;
        /* opacity: 1; */
        /* display: block; */
    }

    .mega-dropdown .col-sm-3 {
        float: right;
        direction: rtl !important;
        list-style: none;
    }

    .dropdown-menu li a:hover, .dropdown-menu li a:focus, .dropdown-menu li a:active {
        background-color: #c9ccd259;
        color: #FFFFFF;
        border-radius: 5px;
    }
</style>


<p>
    <?= Html::a(
        'ایجاد منو',
        ['create'],
        ['class' => 'btn btn-success create']
    ) ?>

    <?= Html::a(
        'انتشار در سایت',
        ['publish'],
        ['class' => 'btn btn-danger publish']
    ) ?>
</p>
<div class="row">
    <div class="col-md-12">
        <?= $provider->getMegaMenu($menu, true); ?>
    </div>
</div>

