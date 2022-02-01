<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\modules\pages\models\Pages;
use YiiMan\YiiBasics\modules\pages\widgets\htmlBuilder\assets\Assets;

/**
 * @var $id   int
 * @var $this \YiiMan\YiiBasics\lib\View
 */
$assets = Assets::register($this);
$model = Pages::findOne($id);
$jsAssetURL = Yii::$app->Options->URL.$assets->baseUrl;
//@mkdir(Yii::$app->Options->UploadDir.'/samplePages', 0755, true);
//
//$indexFile = fopen(Yii::$app->Options->UploadDir.'/samplePages/index.php', 'w+');
//fwrite($indexFile, (!empty($model->content) ? $model->content : ''));
//fclose($indexFile);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <base href="">
    <title><?= empty($model->title) ? 'صفحه ی جدید' : 'ویرایش برگه: '.$model->title ?></title>

    <link href="<?= $assets->baseUrl ?>/css/editor.css" rel="stylesheet">
    <link href="<?= $assets->baseUrl ?>/css/line-awesome.css" rel="stylesheet">
    <link href="<?= $assets->baseUrl ?>/css/style.css" rel="stylesheet">
    <link href="<?= $assets->baseUrl ?>/libs/editor/content-tools.min.css" rel="stylesheet">
    <link href="<?= $assets->baseUrl ?>/css/skin-win8/ui.fancytree.min.css" rel="stylesheet">
    <link href="<?= $assets->baseUrl ?>/tippy.css" rel="stylesheet">
    <link href="<?= $assets->baseUrl ?>/contextMenu/jquery.contextMenu.min.css" rel="stylesheet">
    <link href="<?= $assets->baseUrl ?>/libs/codemirror/lib/foldgutter.css" rel="stylesheet">
    <script>
        var asseturlt = '<?= $jsAssetURL ?>/';
        var backend = '<?= Yii::$app->Options->BackendUrl ?>';
        var saveUrl = '<?= Yii::$app->Options->BackendUrl ?>/pages/widget/save';
        var uploadUrl = '<?= Yii::$app->Options->BackendUrl ?>/pages/widget/upload?id=<?= $id ?>';
        var exitUrl = '<?= Yii::$app->Options->BackendUrl ?>/pages/';
    </script>
</head>
<body>
<script language="JavaScript" type="text/javascript">
    //<![CDATA[
    window.onbeforeunload = function () {
        return 'آیا واقعا قصد ترک این صفحه را دارید؟';
    };
    //]]>


</script>
<style>

    * {
        user-select: all !important;
        transition: none !important;
    }

    .tippy-tooltip[data-animation="fade"][data-state="hidden"] {
        opacity: 1 !important;
    }

    .tippy-popper {
        max-width: 240px;
    }

    #vvveb-builder #select-actions, #vvveb-builder #wysiwyg-editor {
        position: absolute;
        z-index: 999999;
        height: 37px;
    }

    #vvveb-builder #select-actions a, #vvveb-builder #wysiwyg-editor a, #vvveb-builder #section-actions a#add-section-btn {
        height: 36px;
        display: inline-block;
    }

    #vvveb-builder #highlight-name {
        position: absolute;
        z-index: 999999;
        height: 36px;
        line-height: 2.5;
    }

    .btn-group.page-title {
        height: 32px;
        margin-top: 5px;
    }

    .page-title.btn-group label {
        width: 110px;
        float: right;
    }

    .page-title.btn-group input {
        float: right;
        direction: rtl;
    }

    #vvveb-builder .components-list, #vvveb-builder .blocks-list, #vvveb-builder .component-properties {
        height: 98%;
        height: calc(100% - 250px - 90px - 40px);
        height: 100%;
        overflow-x: hidden;
        list-style: none;
        background: #fafbfc;
        overflow-y: hidden;
    }

    #openModal {
        height: 31px !important;
        font-size: 14px !important;
        width: 160px;
        font-weight: 400;
        font-family: IRANSans;
        background: #fafafa;
        color: black;
    }

    #imageBack {
        width: 100%;
        border-radius: 5px;
        box-shadow: 0 5px 15px -8px rgba(0, 0, 0, .24), 0 8px 10px -5px rgba(0, 0, 0, .2);
        margin-top: 20px;
        margin-bottom: 20px;
    }

    #detailModal {
        direction: rtl;
    }

    #defaultPage {
        margin-left: auto !important;
        margin-right: -1.25rem;
    }

    #detailModal .form-check {
        float: right;
    }

    #detailModal .form-check.mb-2 {
        margin-left: auto !important;
        margin-right: 1.25rem !important;
    }

    #detailModal .modal-header .close {
        padding: 1rem 1rem;
        margin: -1rem -1rem auto -1rem !important;
    }

    #vvveb-builder #section-actions a#add-section-btn {
        width: 30px;
        height: 30px !important;
    }

    #add-section-btn .la.la-plus {
        padding-left: 2px;
        padding-top: 0px;
        margin-top: 3px;
        display: block;
    }

    label.header {
        text-align: right;
        padding: 0.3rem 0 0 0.3rem;
        padding: 0rem 0.5rem 0.5rem 0.5rem !important;
        direction: rtl;

    }

    #right-panel label.header .header-arrow {
        left: 5px !important;
        right: auto !important;
        float: left;
    }

    #vvveb-builder .drag-elements > .header .search .form-control {
        text-align: right;
    }

    #vvveb-builder .drag-elements > .header .search .clear-backspace {
        left: 0 !important;

        right: auto !important;
    }

    #vvveb-builder .component-properties .form-group > label {
        text-align: right;
        float: right;
        direction: rtl;
    }

    #blocks .drag-elements-sidepane li[data-type] {
        height: auto !important;
    }

    #blocks .drag-elements-sidepane li[data-type] p {
        width: 234px;
        /* height: 50px; */
        display: block;
        position: relative;
        font-family: IRANSans;
        word-wrap: break-word;
        white-space: normal;
        padding: 6px;
        background: #fbfffb;
    }

    #blocks .drag-elements-sidepane li[data-type] a {
        background: #fff;
        padding: 5px 0px 0px 0px;
        font-weight: 800;
        font-family: Aviny;
        font-size: 15px;
    }

    label.header .header-arrow {
        left: 15px;
        right: auto;
    }

    .drag-elements-sidepane ul > li.header label {
        text-align: right;
    }

    #logo {
        margin-left: 0.5rem;
        margin-top: 0.15rem;
        height: 35px;
    }

    .modal-fields .control-label {
        float: right;
    }

    #add-section-box .header {
        width: 100%;
        display: block;
        float: right;
    }

    #add-section-box li li {
        display: block;
        margin-right: 10px !important;
        height: auto !important;
    }

    #add-section-box li li p, #add-section-box li li a {
        display: block;
        position: relative;
        float: right;
        padding: 5px;
        /* word-wrap: break-word; */
        word-spacing: normal;
        /* word-break: break-word; */
        word-wrap: break-word;
        word-break: break-word;
        white-space: normal;
    }



    .item-location-box {
        width: 300px;
        display: flex;
        flex-wrap: wrap;
        flex-direction: row-reverse;
        height: 40px;
        position: absolute;
        right: 0;
        top: -12px;
    }

    #vvveb-builder #top-panel {
        z-index: 9999999;
        position: fixed;
    }
</style>

<script id="vvveb-section" type="text/html">


    <div class="section-item" id="{%=id%}">
        <div class="handle"></div>
        <div>
            <div class="name">{%=name%}
                <div class="type">{%=type%}</div>
            </div>
        </div>
        <div class="buttons">
            <span class="delete-btn" href="" title="Remove element"><i class="la la-trash text-danger"></i></span>
            <span class="up-btn" href="" title="Move element up"><i class="la la-arrow-up"></i></span>
            <span class="down-btn" href="" title="Move element down"><i class="la la-arrow-down"></i></span>
            <span class="properties-btn" href="" title="Properties"><i class="la la-cog"></i></span>
        </div>
    </div>


</script>
<script id="vvveb-page-details" type="text/html">
    <div class="modal" tabindex="-1" role="dialog" id="detailModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">مشخصات برگه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 modal-fields">
                            <div class="form-group">
                                <label class="control-label"
                                       style="direction: <?= \YiiMan\YiiBasics\lib\i18n\Layout::run() ?>"
                                       for="slug">نامک</label>
                                <style>     #slughinthelp {
                                        margin-top: 11px;
                                        display: block;
                                    } </style>
                                <input type="text" class="form-control"
                                       value="<?= $slug = \YiiMan\YiiBasics\modules\slug\models\Slug::getSlug($model) ?>"
                                       id="slug">

                                <?php
                                if (empty($slug)) {
                                    $slug = 'page/'.$model->id;
                                }
                                ?>
                                <span id="slughinthelp">
                            <a class="slug-link" href="<?= Yii::$app->Options->URL.'/'.$slug ?>"
                               target="_blank"><?= Yii::$app->Options->URL.'/'.$slug ?></a>

                                    <p style="text-align: right">نامک همان آدرس مستقیم صفحه است</p>
                                <p style="text-align: right">چنانچه نامک را پر کنید، این صفحه به صورت زیر با آدرس مستقیم در دسترس خواهد بود:</p>
                                <p style="text-align: left;direction: ltr"><?= Yii::$app->Options->URL.'/نامک شما' ?></p>
                            </span>
                                <p class="help-block help-block-error"></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label"
                                       style="direction: <?= \YiiMan\YiiBasics\lib\i18n\Layout::run() ?>"
                                       for="pageType">مدل صفحه</label>

                                <select type="text" class="form-control" id="pageType">
                                    <?php
                                    foreach (\YiiMan\YiiBasics\modules\pages\models\Pages::getAllTemplates() as $item) {
                                        $selected = '';
                                        if ($item['name'] == $model->template) {
                                            $selected = ' selected';
                                        }
                                        echo '<option value="'.$item['name'].'" '.$selected.'>'.$item['label'].'</option>';
                                    }
                                    ?>
                                </select>

                                <p class="help-block help-block-error"></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label"
                                       style="direction: <?= \YiiMan\YiiBasics\lib\i18n\Layout::run() ?>"
                                       for="status">وضعیت انتشار</label>

                                <select type="text" class="form-control" id="status">
                                    <?php
                                    foreach ([
                                                 0 => 'پیش نویس',
                                                 1 => 'منتشر شده'
                                             ] as $k => $v) {
                                        $selected = '';
                                        if ($k == $model->status) {
                                            $selected = ' selected';
                                        }
                                        echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
                                    }
                                    ?>
                                </select>

                                <p class="help-block help-block-error"></p>
                            </div>
                            <div class="form-group">
                                <label for="seodesc" class="control-label">توضیحات سئو</label>

                                <textarea type="text" class="form-control"
                                          id="seodesc"><?= $model->seo_description ?></textarea>


                                <p style="text-align: right">توضیحی کوتاه در مورد این صفحه به موتور های جست و جو مانند
                                    گوگل بدهید</p>
                            </div>
                            <div class="form-group">
                                <label for="backgroundFile" class="control-label">تصویر هدر صفحه</label>
                                <input type="hidden" id="fileBack" value="<?= $model->back ?>">
                                <img src="<?= empty($model->back) ? '#' : $model->back ?>" id="imageBack"
                                     class="backimg" style="display: <?= empty($model->back) ? 'none' : 'block' ?>"
                                     alt="">
                                <input type="file" class="form-control"
                                       id="backgroundFile" value="<?= empty($model->back) ? '' : $model->back ?>">

                            </div>

                            <div class="form-check mb-2">
                                <?php
                                if (!$model->default) {
                                    ?>
                                    <input class="form-check-input" type="checkbox" value="11" id="defaultPage">
                                    <label class="form-check-label" for="defaultPage">
                                        انتخاب به عنوان صفحه ی خانه
                                    </label>
                                    <?php
                                } else {
                                    ?>
                                    <span style="color: green">این صفحه ی پیش فرض سایت(صفحه ی نخست) است</span>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success modal-submit" data-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>
</script>

<div id="vvveb-builder">

    <div id="top-panel">

        <img src="<?= Yii::$app->Options->logo ?>" <?= \YiiMan\YiiBasics\widgets\TippyTooltip\TippyWidget::attribute('سازنده ی این سیستم') ?>
             alt="Vvveb" class="float-left" id="logo">


        <div class="btn-group float-left" role="group">

            <button class="btn btn-light" <?= \YiiMan\YiiBasics\widgets\TippyTooltip\TippyWidget::attribute('پنل سمت چپ') ?>
                    title="Toggle left column" id="toggle-left-column-btn"
                    data-vvveb-action="toggleLeftColumn" data-toggle="button" aria-pressed="false">
                <img src="<?= $assets->baseUrl ?>/libs/builder/icons/left-column-layout.svg" width="20px" height="20px">
            </button>

            <button class="btn btn-light" title="Toggle right column" id="toggle-right-column-btn"
                    data-vvveb-action="toggleRightColumn" data-toggle="button" aria-pressed="false">
                <img src="<?= $assets->baseUrl ?>/libs/builder/icons/right-column-layout.svg" width="20px"
                     height="20px">
            </button>
        </div>

        <div class="btn-group mr-3" role="group">
            <button class="btn btn-light" title="بازگردانی آخرین اقدام (Ctrl/Cmd + Z)" id="undo-btn"
                    data-vvveb-action="undo"
                    data-vvveb-shortcut="ctrl+z">
                <i class="la la-undo"></i>
            </button>

            <button class="btn btn-light" title="دوباره آخرین اقدام را انجام بده (Ctrl/Cmd + Shift + Z)" id="redo-btn"
                    data-vvveb-action="redo"
                    data-vvveb-shortcut="ctrl+shift+z">
                <i class="la la-undo la-flip-horizontal"></i>
            </button>
        </div>


        <div class="btn-group mr-3" role="group">
            <button class="btn btn-light" title="مدل طراح (ویجت ها را راحت با کشیدن و رها کردن به صفحه اضافه کنید)"
                    id="designer-mode-btn"
                    data-toggle="button" aria-pressed="false" data-vvveb-action="setDesignerMode">
                <i class="la la-hand-grab-o"></i>
            </button>

            <button class="btn btn-light" title="بازبینی تغییرات" id="preview-btn" type="button" data-toggle="button"
                    aria-pressed="false" data-vvveb-action="preview">
                <i class="la la-eye"></i>
            </button>

            <button class="btn btn-light" title="ویرایشگر را تمام صفحه کنید (F11)" id="fullscreen-btn"
                    data-toggle="button"
                    aria-pressed="false" data-vvveb-action="fullscreen">
                <i class="la la-arrows"></i>
            </button>

            <button class="btn btn-light" title="خروج از ویرایشگر و بازگشت به پنل" id="exit-btn"
                    data-toggle="button"
                    aria-pressed="false" data-vvveb-action="exit">
                <i class="las la-door-open"></i>
            </button>

        </div>

        <div class="btn-group mr-3" role="group">
            <button class="btn btn-light" title="ذخیره ی تغییرات (Ctrl + E)" id="save-btn" data-vvveb-action="saveAjax"
                    data-vvveb-shortcut="ctrl+e">
                <i class="la la-save"></i>
            </button>

            <!--            <button class="btn btn-light" title="Download" id="download-btn" data-vvveb-action="download"-->
            <!--                    data-download="index.html">-->
            <!--                <i class="la la-download"></i>-->
            <!--            </button>-->
        </div>


        <div class="btn-group float-right responsive-btns" role="group">
            <button id="mobile-view" data-view="mobile" class="btn btn-light" title="نمای موبایل"
                    data-vvveb-action="viewport">
                <i class="la la-mobile-phone"></i>
            </button>

            <button id="tablet-view" data-view="tablet" class="btn btn-light" title="نمای تبلت"
                    data-vvveb-action="viewport">
                <i class="la la-tablet"></i>
            </button>

            <button id="desktop-view" data-view="" class="btn btn-light" title="نمای رایانه ی رومیزی"
                    data-vvveb-action="viewport">
                <i class="la la-laptop"></i>
            </button>

        </div>

        <div class="btn-group page-title float-right responsive-btns" role="group">
            <button type="button" id="openModal" class="btn btn-small btn-info">اطلاعات برگه</button>
            <input type="text" class="form-control" value="<?= $model->title ?>">
            <label>نام صفحه</label>
        </div>

    </div>

    <div id="left-panel">

        <div class="drag-elements">

            <div class="header">
                <ul class="nav nav-tabs" id="elements-tabs" role="tablist">
                    <ul class="nav nav-tabs  nav-fill" id="elements-tabs" role="tablist">
                        <li class="nav-item component-tab">
                            <a class="nav-link active" id="components-tab" data-toggle="tab" href="#components"
                               role="tab" aria-controls="components" aria-selected="true" title="Components">
                                <img src="<?= $assets->baseUrl ?>/libs/builder/icons/product.svg" height="23">
                                <div><small>اجزاء</small></div>
                            </a>
                        </li>
                        <!-- li class="nav-item blocks-tab">
                          <a class="nav-link" id="blocks-tab" data-toggle="tab" href="#blocks" role="tab" aria-controls="blocks" aria-selected="false" title="Sections"><img src="libs/builder/icons/list_group.svg" width="24" height="23"> <div><small>Sections</small></div></a>
                        </li -->
                        <li class="nav-item blocks-tab">
                            <a class="nav-link" id="blocks-tab" data-toggle="tab" href="#blocks" role="tab"
                               aria-controls="blocks" aria-selected="false" title="Blocks">
                                <img src="<?= $assets->baseUrl ?>/libs/builder/icons/list_group.svg" height="23">
                                <div><small>بخش ها</small></div>
                            </a>
                        </li>
                        <li class="nav-item component-properties-tab" style="display:none">
                            <a class="nav-link" id="properties-tab" data-toggle="tab" href="#properties" role="tab"
                               aria-controls="blocks" aria-selected="false" title="Properties">
                                <img src="<?= $assets->baseUrl ?>/libs/builder/icons/filters.svg" height="23">
                                <div><small>خصوصیات</small></div>
                            </a>
                        </li>
                    </ul>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="components" role="tabpanel"
                         aria-labelledby="components-tab">

                        <div class="search">
                            <input class="form-control form-control-sm component-search" placeholder="جست و جو در اجزا"
                                   type="text" data-vvveb-action="componentSearch" data-vvveb-on="keyup">
                            <button class="clear-backspace" data-vvveb-action="clearComponentSearch">
                                <i class="la la-close"></i>
                            </button>
                        </div>

                        <div class="drag-elements-sidepane sidepane">
                            <div>

                                <ul class="components-list clearfix" data-type="leftpanel">
                                </ul>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="blocks" role="tabpanel" aria-labelledby="blocks-tab">


                        <ul class="nav nav-tabs nav-fill sections-tabs" id="properties-tabs" role="tablist">
                            <li class="nav-item content-tab">
                                <a class="nav-link active" data-toggle="tab" href="#sections-new-tab" role="tab"
                                   aria-controls="components" aria-selected="true">
                                    <i class="la la-plus"></i>
                                    <div><span>افزودن بخش</span></div>
                                </a>
                            </li>
                            <li class="nav-item style-tab">
                                <a class="nav-link" data-toggle="tab" href="#sections-list" role="tab"
                                   aria-controls="blocks" aria-selected="false">
                                    <i class="la la-bars"></i>
                                    <div><span>تگ های موجود</span></div>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="sections-new-tab" data-section="content"
                                 role="tabpanel" aria-labelledby="content-tab">


                                <div class="search">
                                    <input class="form-control form-control-sm block-search"
                                           placeholder="جست و جو در بخش ها" type="text" data-vvveb-action="blockSearch"
                                           data-vvveb-on="keyup">
                                    <button class="clear-backspace" data-vvveb-action="clearBlockSearch">
                                        <i class="la la-close"></i>
                                    </button>
                                </div>


                                <div class="drag-elements-sidepane sidepane">
                                    <div>

                                        <ul class="blocks-list clearfix" data-type="leftpanel">
                                        </ul>

                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade show" id="sections-list" data-section="style" role="tabpanel"
                                 aria-labelledby="style-tab">
                                <input type="text" id="fancysearch" placeholder="جست و جو در تگ ها"
                                       style="direction: rtl" class="form-control form-control-sm ">
                                <div class="sections">

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="tab-pane fade" id="properties" role="tabpanel" aria-labelledby="blocks-tab">
                        <div class="component-properties-sidepane">
                            <div>
                                <div class="component-properties">
                                    <ul class="nav nav-tabs nav-fill" id="properties-tabs" role="tablist">
                                        <li class="nav-item content-tab">
                                            <a class="nav-link active" data-toggle="tab" href="#content-left-panel-tab"
                                               role="tab" aria-controls="components" aria-selected="true">
                                                <i class="la la-lg la-cube"></i>
                                                <div><span>Content</span></div>
                                            </a>
                                        </li>
                                        <li class="nav-item style-tab">
                                            <a class="nav-link" data-toggle="tab" href="#style-left-panel-tab"
                                               role="tab" aria-controls="blocks" aria-selected="false">
                                                <i class="la la-lg la-image"></i>
                                                <div><span>Style</span></div>
                                            </a>
                                        </li>
                                        <li class="nav-item advanced-tab">
                                            <a class="nav-link" data-toggle="tab" href="#advanced-left-panel-tab"
                                               role="tab" aria-controls="blocks" aria-selected="false">
                                                <i class="la la-lg la-cog"></i>
                                                <div><span>Advanced</span></div>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="content-left-panel-tab"
                                             data-section="content" role="tabpanel" aria-labelledby="content-tab">
                                            <div class="mt-4 text-center">Click on an element to edit.</div>
                                        </div>

                                        <div class="tab-pane fade show" id="style-left-panel-tab" data-section="style"
                                             role="tabpanel" aria-labelledby="style-tab">
                                        </div>

                                        <div class="tab-pane fade show" id="advanced-left-panel-tab"
                                             data-section="advanced" role="tabpanel" aria-labelledby="advanced-tab">
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


    <div id="canvas">
        <div id="iframe-wrapper">
            <div id="iframe-layer">

                <div id="highlight-box">
                    <div id="highlight-name"></div>

                    <div id="section-actions">
                        <a id="add-section-btn" href="" title="افزودن آیتم"><i class="la la-plus"></i></a>
                    </div>
                </div>

                <div id="select-box">

                    <div id="wysiwyg-editor">
                        <a id="bold-btn" href="" title="برجسته سازی"><i><strong>B</strong></i></a>
                        <a id="italic-btn" href="" title="کج کردن متن"><i>I</i></a>
                        <a id="underline-btn" href="" title="خط زیر"><u>u</u></a>
                        <a id="right-btn" href="" title="خط زیر"><i class="las la-align-right"></i></a>
                        <a id="center-btn" href="" title="خط زیر"><i class="las la-align-center"></i></a>
                        <a id="left-btn" href="" title="خط زیر"><i class="las la-align-left"></i></a>
                        <a id="strike-btn" href="" title="Strikeout">
                            <del>S</del>
                        </a>
                        <a id="link-btn" href="" title="ایجاد لینک"><strong>a</strong></a>
                    </div>

                    <div id="select-actions">
                        <a id="drag-btn" href="" title="آیتم را درگ کنید"><i class="la la-arrows"></i></a>
                        <a id="parent-btn" href="" title="انتقال به بیرون"><i
                                    class="la la-level-down la-rotate-180"></i></a>
                        <a id="add-section-float-btn" href="" title="افزودن آیتم"><i class="la la-plus"></i></a>

                        <a id="up-btn" href="" title="جابجایی به بالا"><i class="la la-arrow-up"></i></a>
                        <a id="down-btn" href="" title="جابجایی به پایین"><i class="la la-arrow-down"></i></a>
                        <a id="clone-btn" href="" title="ایجاد یکی مشابه این"><i class="la la-copy"></i></a>
                        <a id="delete-btn" href="" title="حذف این آیتم"><i class="la la-trash"></i></a>
                    </div>
                </div>

                <!-- add section box -->
                <div id="add-section-box" class="drag-elements">

                    <div class="header">
                        <ul class="nav nav-tabs" id="box-elements-tabs" role="tablist">
                            <li class="nav-item component-tab">
                                <a class="nav-link active" id="box-components-tab" data-toggle="tab"
                                   href="#box-components" role="tab" aria-controls="components" aria-selected="true"><i
                                            class="la la-lg la-cube"></i>
                                    <div><small>ابزارک ها</small></div>
                                </a>
                            </li>
                            <li class="nav-item blocks-tab">
                                <a class="nav-link" id="box-blocks-tab" data-toggle="tab" href="#box-blocks" role="tab"
                                   aria-controls="blocks" aria-selected="false"><i class="la la-lg la-image"></i>
                                    <div><small>بلوک ها</small></div>
                                </a>
                            </li>
                            <li class="nav-item component-properties-tab" style="display:none">
                                <a class="nav-link" id="box-properties-tab" data-toggle="tab" href="#box-properties"
                                   role="tab" aria-controls="blocks" aria-selected="false"><i
                                            class="la la-lg la-cog"></i>
                                    <div><small>خصوصیات و پارامترها</small></div>
                                </a>
                            </li>
                        </ul>

                        <div class="section-box-actions">

                            <div id="close-section-btn" class="btn btn-light btn-sm bg-white btn-sm float-right"><i
                                        class="la la-close"></i></div>

                            <div class="small mt-1 mr-3 float-right item-location-box">

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="add-section-insert-mode-after" value="after"
                                           checked="checked" name="add-section-insert-mode"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="add-section-insert-mode-after">بعد از این
                                        آیتم</label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="add-section-insert-mode-inside" value="inside"
                                           name="add-section-insert-mode" class="custom-control-input">
                                    <label class="custom-control-label"
                                           for="add-section-insert-mode-inside">داخل این آیتم</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="add-section-insert-mode-before" value="before"
                                           name="add-section-insert-mode" class="custom-control-input">
                                    <label class="custom-control-label"
                                           for="add-section-insert-mode-before">قبل از این آیتم</label>
                                </div>

                            </div>

                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="box-components" role="tabpanel"
                                 aria-labelledby="components-tab">

                                <div class="search">
                                    <input class="form-control form-control-sm component-search"
                                           placeholder="جست و جو در ابزارک ها" type="text"
                                           data-vvveb-action="addBoxComponentSearch" data-vvveb-on="keyup">
                                    <button class="clear-backspace" data-vvveb-action="clearComponentSearch">
                                        <i class="la la-close"></i>
                                    </button>
                                </div>

                                <div>
                                    <div>

                                        <ul class="components-list clearfix" data-type="addbox">
                                        </ul>

                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="box-blocks" role="tabpanel" aria-labelledby="blocks-tab">

                                <div class="search">
                                    <input class="form-control form-control-sm block-search"
                                           placeholder="جست و جو در بلوک ها"
                                           type="text" data-vvveb-action="addBoxBlockSearch" data-vvveb-on="keyup">
                                    <button class="clear-backspace" data-vvveb-action="clearBlockSearch">
                                        <i class="la la-close"></i>
                                    </button>
                                </div>

                                <div>
                                    <div>

                                        <ul class="blocks-list clearfix" data-type="addbox">
                                        </ul>

                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="box-properties" role="tabpanel" aria-labelledby="blocks-tab">
                                <div class="component-properties-sidepane">
                                    <div>
                                        <div class="component-properties">
                                            <div class="mt-4 text-center">برای ویرایش روی یک آیتم کلیک کنید</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- //add section box -->
            </div>
            <iframe src="about:none" id="iframe1"></iframe>
        </div>


    </div>

    <div id="right-panel">
        <div class="component-properties">

            <ul class="nav nav-tabs nav-fill" id="properties-tabs" role="tablist">
                <li class="nav-item content-tab">
                    <a class="nav-link active" data-toggle="tab" href="#content-tab" role="tab"
                       aria-controls="components" aria-selected="true">
                        <i class="la la-lg la-cube"></i>
                        <div><span>محتوا</span></div>
                    </a>
                </li>
                <li class="nav-item style-tab">
                    <a class="nav-link" data-toggle="tab" href="#style-tab" role="tab" aria-controls="blocks"
                       aria-selected="false">
                        <i class="la la-lg la-image"></i>
                        <div><span>سبک و ظاهر</span></div>
                    </a>
                </li>
                <li class="nav-item advanced-tab">
                    <a class="nav-link" data-toggle="tab" href="#advanced-tab" role="tab" aria-controls="blocks"
                       aria-selected="false">
                        <i class="la la-lg la-cog"></i>
                        <div><span>پیشرفته</span></div>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="content-tab" data-section="content" role="tabpanel"
                     aria-labelledby="content-tab">
                </div>

                <div class="tab-pane fade show" id="style-tab" data-section="style" role="tabpanel"
                     aria-labelledby="style-tab">
                </div>

                <div class="tab-pane fade show" id="advanced-tab" data-section="advanced" role="tabpanel"
                     aria-labelledby="advanced-tab">
                </div>


            </div>


        </div>
    </div>

    <div id="bottom-panel">

        <div class="btn-group" role="group">

            <button id="code-editor-btn" data-view="mobile" class="btn btn-sm btn-light btn-sm" title="Code editor"
                    data-vvveb-action="toggleEditor">
                <i class="la la-code"></i> ویرایش کد
            </button>

            <div id="toggleEditorJsExecute" class="custom-control custom-checkbox mt-1" style="display:none">
                <input type="checkbox" class="custom-control-input" id="customCheck" name="example1"
                       data-vvveb-action="toggleEditorJsExecute">
                <label class="custom-control-label" for="customCheck"><small>اجرای کد جاوا اسکریپت در زمان
                        ویرایش</small></label>
            </div>
        </div>

        <div id="vvveb-code-editor">
            <textarea class="form-control"></textarea>
            <div>

            </div>
        </div>
    </div>


    <!-- templates -->

    <script id="vvveb-input-textinput" type="text/html">

        <div>
            <input name="{%=key%}" type="text" class="form-control"/>
        </div>

    </script>

    <script id="vvveb-input-textareainput" type="text/html">

        <div>
            <textarea name="{%=key%}" rows="3" class="form-control"/>
        </div>

    </script>

    <script id="vvveb-input-checkboxinput" type="text/html">

        <div class="custom-control custom-checkbox">
            <input name="{%=key%}" class="custom-control-input" type="checkbox" id="{%=key%}_check">
            <label class="custom-control-label" for="{%=key%}_check">{% if (typeof text !== 'undefined') { %} {%=text%}
                {% } %}</label>
        </div>

    </script>

    <script id="vvveb-input-radioinput" type="text/html">

        <div>

            {% for ( var i = 0; i < options.length; i++ ) { %}

            <label class="custom-control custom-radio  {% if (typeof inline !== 'undefined' && inline == true) { %}custom-control-inline{% } %}"
                   title="{%=options[i].title%}">
                <input name="{%=key%}" class="custom-control-input" type="radio" value="{%=options[i].value%}"
                       id="{%=key%}{%=i%}" {%if (options[i].checked) { %}checked="{%=options[i].checked%}" {% } %}>
                <label class="custom-control-label" for="{%=key%}{%=i%}">{%=options[i].text%}</label>
            </label>

            {% } %}

        </div>

    </script>

    <script id="vvveb-input-radiobuttoninput" type="text/html">

        <div class="btn-group btn-group-toggle  {%if (extraclass) { %}{%=extraclass%}{% } %} clearfix"
             data-toggle="buttons">

            {% for ( var i = 0; i < options.length; i++ ) { %}

            <label class="btn  btn-outline-primary  {%if (options[i].checked) { %}active{% } %}  {%if (options[i].extraclass) { %}{%=options[i].extraclass%}{% } %}"
                   for="{%=key%}{%=i%} " title="{%=options[i].title%}">
                <input name="{%=key%}" class="custom-control-input" type="radio" value="{%=options[i].value%}"
                       id="{%=key%}{%=i%}" {%if (options[i].checked) { %}checked="{%=options[i].checked%}" {% } %}>
                {%if (options[i].icon) { %}<i class="{%=options[i].icon%}"></i>{% } %}
                {%=options[i].text%}
            </label>

            {% } %}

        </div>

    </script>


    <script id="vvveb-input-toggle" type="text/html">

        <div class="toggle">
            <input type="checkbox" name="{%=key%}" value="{%=on%}" data-value-off="{%=off%}" data-value-on="{%=on%}"
                   class="toggle-checkbox" id="{%=key%}">
            <label class="toggle-label" for="{%=key%}">
                <span class="toggle-inner"></span>
                <span class="toggle-switch"></span>
            </label>
        </div>

    </script>

    <script id="vvveb-input-header" type="text/html">

        <h6 class="header">{%=header%}</h6>

    </script>


    <script id="vvveb-input-select" type="text/html">

        <div>

            <select class="form-control custom-select">
                {% for ( var i = 0; i < options.length; i++ ) { %}
                <option value="{%=options[i].value%}">{%=options[i].text%}</option>
                {% } %}
            </select>

        </div>

    </script>


    <script id="vvveb-input-listinput" type="text/html">

        <div class="row">

            {% for ( var i = 0; i < options.length; i++ ) { %}
            <div class="col-6">
                <div class="input-group">
                    <input name="{%=key%}_{%=i%}" type="text" class="form-control" value="{%=options[i].text%}"/>
                    <div class="input-group-append">
                        <button class="input-group-text btn btn-sm btn-danger">
                            <i class="la la-trash la-lg"></i>
                        </button>
                    </div>
                </div>
                <br/>
            </div>
            {% } %}


            {% if (typeof hide_remove === 'undefined') { %}
            <div class="col-12">

                <button class="btn btn-sm btn-outline-primary">
                    <i class="la la-trash la-lg"></i> افزودن جدید
                </button>

            </div>
            {% } %}

        </div>

    </script>

    <script id="vvveb-input-grid" type="text/html">

        <div class="row">
            <div class="mb-1 col-12">

                <label>فلکس باکس</label>
                <select class="form-control custom-select" name="col">

                    <option value="">None</option>
                    {% for ( var i = 1; i <= 12; i++ ) { %}
                    <option value="{%=i%}" {% if ((typeof col !==
                    'undefined') && col == i) { %} selected {% } %}>{%=i%}</option>
                    {% } %}

                </select>
                <br/>
            </div>

            <div class="col-6">
                <label>خیلی کوچک</label>
                <select class="form-control custom-select" name="col-xs">

                    <option value="">None</option>
                    {% for ( var i = 1; i <= 12; i++ ) { %}
                    <option value="{%=i%}" {% if ((typeof col_xs !==
                    'undefined') && col_xs == i) { %} selected {% } %}>{%=i%}</option>
                    {% } %}

                </select>
                <br/>
            </div>

            <div class="col-6">
                <label>کوچک</label>
                <select class="form-control custom-select" name="col-sm">

                    <option value="">None</option>
                    {% for ( var i = 1; i <= 12; i++ ) { %}
                    <option value="{%=i%}" {% if ((typeof col_sm !==
                    'undefined') && col_sm == i) { %} selected {% } %}>{%=i%}</option>
                    {% } %}

                </select>
                <br/>
            </div>

            <div class="col-6">
                <label>متوسط</label>
                <select class="form-control custom-select" name="col-md">

                    <option value="">None</option>
                    {% for ( var i = 1; i <= 12; i++ ) { %}
                    <option value="{%=i%}" {% if ((typeof col_md !==
                    'undefined') && col_md == i) { %} selected {% } %}>{%=i%}</option>
                    {% } %}

                </select>
                <br/>
            </div>

            <div class="col-6 mb-1">
                <label>Large</label>
                <select class="form-control custom-select" name="col-lg">

                    <option value="">None</option>
                    {% for ( var i = 1; i <= 12; i++ ) { %}
                    <option value="{%=i%}" {% if ((typeof col_lg !==
                    'undefined') && col_lg == i) { %} selected {% } %}>{%=i%}</option>
                    {% } %}

                </select>
                <br/>
            </div>

            {% if (typeof hide_remove === 'undefined') { %}
            <div class="col-12">

                <button class="btn btn-sm btn-outline-light text-danger">
                    <i class="la la-trash la-lg"></i> Remove
                </button>

            </div>
            {% } %}

        </div>

    </script>

    <script id="vvveb-input-textvalue" type="text/html">

        <div class="row">
            <div class="col-6 mb-1">
                <label>مقدار</label>
                <input name="value" type="text" value="{%=value%}" class="form-control"/>
            </div>

            <div class="col-6 mb-1">
                <label>متن</label>
                <input name="text" type="text" value="{%=text%}" class="form-control"/>
            </div>

            {% if (typeof hide_remove === 'undefined') { %}
            <div class="col-12">

                <button class="btn btn-sm btn-outline-light text-danger">
                    <i class="la la-trash la-lg"></i> حذف
                </button>

            </div>
            {% } %}

        </div>

    </script>

    <script id="vvveb-input-rangeinput" type="text/html">

        <div>
            <input name="{%=key%}" type="range" min="{%=min%}" max="{%=max%}" step="{%=step%}" class="form-control"/>
        </div>

    </script>

    <script id="vvveb-input-imageinput" type="text/html">

        <div>
            <input name="{%=key%}" type="text" class="form-control"/>
            <input name="file" type="file" class="form-control"/>
        </div>

    </script>

    <script id="vvveb-input-colorinput" type="text/html">

        <div>
            <input name="{%=key%}" type="color" {% if (typeof value !== 'undefined' && value != false) { %}
            value="{%=value%}" {% } %} pattern="#[a-f0-9]{6}" class="form-control"/>
        </div>

    </script>

    <script id="vvveb-input-bootstrap-color-picker-input" type="text/html">

        <div>
            <div id="cp2" class="input-group" title="Using input value">
                <input name="{%=key%}" type="text" {% if (typeof value !== 'undefined' && value != false) { %}
                value="{%=value%}" {% } %} class="form-control"/>
                <span class="input-group-append">
			<span class="input-group-text colorpicker-input-addon"><i></i></span>
		  </span>
            </div>
        </div>

    </script>

    <script id="vvveb-input-numberinput" type="text/html">
        <div>
            <input name="{%=key%}" type="number" value="{%=value%}"
                   {% if (typeof min !== 'undefined' && min != false) { %}min="{%=min%}"{% } %}
            {% if (typeof max !== 'undefined' && max != false) { %}max="{%=max%}"{% } %}
            {% if (typeof step !== 'undefined' && step != false) { %}step="{%=step%}"{% } %}
            class="form-control"/>
        </div>
    </script>

    <script id="vvveb-input-button" type="text/html">
        <div>
            <button class="btn btn-sm btn-primary">
                <i class="la  {% if (typeof icon !== 'undefined') { %} {%=icon%} {% } else { %} la-plus {% } %} la-lg"></i>
                {%=text%}
            </button>
        </div>
    </script>

    <script id="vvveb-input-cssunitinput" type="text/html">
        <div class="input-group" id="cssunit-{%=key%}">
            <input name="number" type="number" {% if (typeof value !== 'undefined' && value != false) { %}
            value="{%=value%}" {% } %}
            {% if (typeof min !== 'undefined' && min != false) { %}min="{%=min%}"{% } %}
            {% if (typeof max !== 'undefined' && max != false) { %}max="{%=max%}"{% } %}
            {% if (typeof step !== 'undefined' && step != false) { %}step="{%=step%}"{% } %}
            class="form-control"/>
            <div class="input-group-append">
                <select class="form-control custom-select small-arrow" name="unit">
                    <option value="em">em</option>
                    <option value="px">px</option>
                    <option value="%">%</option>
                    <option value="rem">rem</option>
                    <option value="auto">auto</option>
                </select>
            </div>
        </div>

    </script>


    <script id="vvveb-filemanager-folder" type="text/html">
        <li data-folder="{%=folder%}" class="folder">
            <label for="{%=folder%}"><span>{%=folderTitle%}</span></label> <input type="checkbox" id="{%=folder%}"/>
            <ol></ol>
        </li>
    </script>

    <script id="vvveb-filemanager-page" type="text/html">
        <li data-url="{%=url%}" data-page="{%=name%}" class="file">
            <label for="{%=name%}"><span>{%=title%}</span></label> <input type="checkbox" checked id="{%=name%}"/>
            <ol></ol>
        </li>
    </script>

    <script id="vvveb-filemanager-component" type="text/html">
        <li data-url="{%=url%}" data-component="{%=name%}" class="component">
            <a href="{%=url%}"><span>{%=title%}</span></a>
        </li>
    </script>

    <script id="vvveb-input-sectioninput" type="text/html">

        <label class="header" data-header="{%=key%}" for="header_{%=key%}"><span>&ensp;{%=header%}</span>
            <div class="header-arrow"></div>
        </label>
        <p style="direction: rtl;padding:5px;text-align: right">{% if (typeof description !== 'undefined' && description
            != false){ %} {%=description%} {% }else{ %} {%=' '%} {% } %}</p>

        <input class="header_check" type="checkbox" {% if (typeof expanded
               !== 'undefined' && expanded == false) { %} {% } else { %}checked="true"{% } %} id="header_{%=key%}">

        <div class="section" data-section="{%=key%}"></div>

    </script>


    <script id="vvveb-property" type="text/html">

        <div class="form-group {% if (typeof col !== 'undefined' && col != false) { %} col-sm-{%=col%} d-inline-block {% } else { %}row{% } %}"
             data-key="{%=key%}" {% if (typeof group
             !== 'undefined' && group != null) { %}data-group="{%=group%}" {% } %}>

        {% if (typeof name !== 'undefined' && name != false) { %}<label
                class="{% if (typeof inline === 'undefined' ) { %}col-sm-4{% } %} control-label" for="input-model">{%=name%}</label>{% } %}

        <div class="{% if (typeof inline === 'undefined') { %}col-sm-{% if (typeof name !== 'undefined' && name != false) { %}8{% } else { %}12{% } } %} input"></div>
        <p style="direction: rtl;padding:5px;text-align: right">{% if (typeof description !== 'undefined' && description
            != false){ %} {%=description%} {% }else{ %} {%=' '%} {% } %}</p>
        </div>

    </script>

    <script id="vvveb-input-autocompletelist" type="text/html">

        <div>
            <input name="{%=key%}" type="text" class="form-control"/>

            <div class="form-control autocomplete-list" style="min=height: 150px; overflow: auto;">
                <div id="featured-product43"><i class="la la-close"></i> مک بوک
                    <input name="product[]" value="43" type="hidden">
                </div>
                <div id="featured-product40"><i class="la la-close"></i> آیفون
                    <input name="product[]" value="40" type="hidden">
                </div>
                <div id="featured-product42"><i class="la la-close"></i> Apple Cinema 30"
                    <input name="product[]" value="42" type="hidden">
                </div>
                <div id="featured-product30"><i class="la la-close"></i> Canon EOS 5D
                    <input name="product[]" value="30" type="hidden">
                </div>
            </div>
        </div>

    </script>


    <!--// end templates -->


    <!-- export html modal-->
    <div class="modal fade" id="textarea-modal" tabindex="-1" role="dialog" aria-labelledby="textarea-modal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-primary"><i class="la la-lg la-save"></i> Export html</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><small><i class="la la-close"></i></small></span>
                    </button>
                </div>
                <div class="modal-body">

                    <textarea rows="25" cols="150" class="form-control"></textarea>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal"><i
                                class="la la-close"></i> بستن
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- message modal-->
    <div class="modal fade" id="message-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-primary"><i class="la la-lg la-comment"></i> VvvebJs</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><small><i class="la la-close"></i></small></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>برگه با موفقیت ذخیره شد</p>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-primary">Ok</button> -->
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal"><i
                                class="la la-close"></i> بستن
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- new page modal-->
    <div class="modal fade" id="new-page-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">

            <form>

                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title text-primary"><i class="la la-lg la-file"></i> صفحه ی جدید</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><small><i class="la la-close"></i></small></span>
                        </button>
                    </div>

                    <div class="modal-body text">
                        <div class="form-group row" data-key="type">
                            <label class="col-sm-3 control-label">
                                قالب
                                <abbr class="badge badge-pill badge-secondary"
                                      title="This template will be used as a start">?</abbr>
                            </label>
                            <div class="col-sm-9 input">
                                <div>
                                    <select class="form-control custom-select" name="startTemplateUrl">
                                        <option value="new-page-blank-template.html">قالب خالی</option>
                                        <option value="<?= $assets->baseUrl ?>/demo/narrow-jumbotron/index.html">Narrow
                                            jumbotron
                                        </option>
                                        <option value="<?= $assets->baseUrl ?>/demo/album/index.html">آلبوم</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" data-key="href">
                            <label class="col-sm-3 control-label">شماره صفحه</label>
                            <div class="col-sm-9 input">
                                <div>
                                    <input name="title" type="text" class="form-control" placeholder="My page" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" data-key="href">
                            <label class="col-sm-3 control-label">نام فایل</label>
                            <div class="col-sm-9 input">
                                <div>
                                    <input name="fileName" type="text" class="form-control" placeholder="my-page.html"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary btn-lg" type="submit"><i class="la la-check"></i> ایجاد صفحه
                        </button>
                        <button class="btn btn-secondary btn-lg" type="reset" data-dismiss="modal"><i
                                    class="la la-close"></i> لغو
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>


<?php
// < Generate Theme Fonts >
{
    $fonts = \YiiMan\YiiBasics\lib\theme::getFonts();
    if (!empty($fonts)) {
        $fonts = json_encode($fonts);
    }

}
// </ Generate Theme Fonts >


// < generate theme Components >
{
    $components = \YiiMan\YiiBasics\modules\widget\models\Components::getAllComponents();
    $jsComponent = '';
    $cGroup = '';
    foreach ($components as $component) {
        $idc = uniqid();
        $cGroup .= '
Vvveb.BlocksGroup[\''.$component['name'].'\'] = [

';

        // < generate items >
        {
            foreach ($component['items'] as $key => $item) {
                // < generate Group variable >
                {
                    $cGroup .= '"'.$idc.'/'.$item['name'].'"';
                    if (!empty($component['items'][$key + 1])) {
                        $cGroup .= ',';
                    }
                }
                // </ generate Group variable >


                // < Generate Component >
                {
                    $item['content'] = file_get_contents($item['content']);

                    // < Check Image >
                    {
                        $path = Yii::$app->Options->UploadDir.'/pageBuilder/';
                        $pathURL = Yii::$app->Options->UploadUrl.'/pageBuilder/';
                        if (!file_exists($path.$item['name'].'.png')) {
                            @mkdir($path);
                            copy($item['image'], $path.$item['name'].'.png');
                        }
                    }
                    // </ Check Image >


                    $imageContent = $pathURL.$item['name'].'.png';
                    $description = empty($item['description']) ? '' : trim($item['description']);
                    $jsComponent .= <<<JS

Vvveb.Blocks.add("{$idc}/{$item['name']}", {
    name: "{$item['label']}",
    dragHtml: '<img src="{$imageContent}">',    
    image: "{$imageContent}",
    html: `{$item['content']}`,
    description:`{$description}`
});    

JS;

                }
                // </ Generate Component >
            }
            $cGroup .= '];';
        }
        // </ generate items >
    }
}
// </ generate theme Components >
?>


<script>
    <?php
    // < generate JS Variables >
    {
        echo <<<JS
var themeFonts= {$fonts};

JS;

    }
    // </ generate JS Variables >
    ?>
</script>

<!-- jquery-->
<script src="<?= $assets->baseUrl ?>/js/jquery.min.js"></script>
<script src="<?= $assets->baseUrl ?>/js/jquery.ui.js"></script>
<script src="<?= $assets->baseUrl ?>/js/jquery.hotkeys.js"></script>
<script src="<?= $assets->baseUrl ?>/js/jstree.min.js"></script>
<script src="<?= $assets->baseUrl ?>/js/jquery.fancytree-all.min.js"></script>
<script src="<?= $assets->baseUrl ?>/js/jquery.fancytree.filter.js"></script>

<!-- bootstrap-->
<script src="<?= $assets->baseUrl ?>/js/popper.min.js"></script>
<script src="<?= $assets->baseUrl ?>/Tippy.js"></script>
<script src="<?= $assets->baseUrl ?>/js/bootstrap.min.js"></script>

<!-- builder code-->
<script src="<?= $assets->baseUrl ?>/libs/builder/builder.js?ver=<?= Yii::$app->Develop->assetVersion() ?>"></script>
<!-- undo manager-->
<script src="<?= $assets->baseUrl ?>/libs/builder/undo.js"></script>
<!-- inputs-->
<script src="<?= $assets->baseUrl ?>/libs/builder/inputs.js?ver=<?= Yii::$app->Develop->assetVersion() ?>"></script>

<!-- bootstrap colorpicker //uncomment bellow scripts to enable -->
<!--
<script src="libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<link href="libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="libs/builder/plugin-bootstrap-colorpicker.js"></script>
-->

<!-- plugins -->
<script>
    var langId = "<?= Yii::$app->Language->defaultLanguage()->systemCode ?>";
    var translateUrl = "<?= \Yii::$app->urlManager->createUrl(['/language/default/translate']) ?>";
</script>
<!-- code mirror - code editor syntax highlight -->
<link href="<?= $assets->baseUrl ?>/libs/codemirror/lib/codemirror.css" rel="stylesheet"/>
<link href="<?= $assets->baseUrl ?>/libs/codemirror/theme/material.css" rel="stylesheet"/>
<link href="<?= $assets->baseUrl ?>/libs/contextMenu/jquery.contextMenu.min.css" rel="stylesheet"/>
<script src="<?= $assets->baseUrl ?>/libs/codemirror/lib/codemirror.js"></script>
<script src="<?= $assets->baseUrl ?>/libs/contextMenu/jquery.contextMenu.js"></script>
<script src="<?= $assets->baseUrl ?>/libs/contextMenu/jquery.ui.position.min.js"></script>
<script src="<?= $assets->baseUrl ?>/libs/editor/content-tools.min.js"></script>


<script src="<?= $assets->baseUrl ?>/libs/codemirror/lib/xml.js"></script>
<script src="<?= $assets->baseUrl ?>/libs/codemirror/lib/css.js"></script>
<script src="<?= $assets->baseUrl ?>/libs/codemirror/lib/javascript.js"></script>
<script src="<?= $assets->baseUrl ?>/libs/codemirror/lib/foldcode.js"></script>
<script src="<?= $assets->baseUrl ?>/libs/codemirror/lib/foldgutter.js"></script>
<script src="<?= $assets->baseUrl ?>/libs/codemirror/lib/xml-fold.js"></script>
<script src="<?= $assets->baseUrl ?>/libs/codemirror/lib/brace-fold.js"></script>
<script src="<?= $assets->baseUrl ?>/libs/codemirror/lib/comment-fold.js"></script>
<script src="<?= $assets->baseUrl ?>/libs/codemirror/lib/formatting.js"></script>

<script src="<?= $assets->baseUrl ?>/libs/forms/form-render.min.js"></script>
<script src="<?= $assets->baseUrl ?>/libs/forms/formatting.js"></script>

<!-- autocomplete plugin used by autocomplete input-->
<script src="<?= $assets->baseUrl ?>/libs/codemirror/lib/emmet.js"></script>

<script src="<?= $assets->baseUrl ?>/libs/builder/plugin-codemirror.js?ver=<?= Yii::$app->Develop->assetVersion() ?>"></script>
<script src="<?= $assets->baseUrl ?>/sweetalert.js"></script>


<!-- jszip - download page as zip -->
<!-- script src="libs/jszip/jszip.min.js"></script>
<script src="libs/builder/plugin-jszip.js"></script -->


<script>
    $(document).ready(function () {

        //if url has #no-right-panel set one panel <?= $assets->baseUrl ?>/demo
        if (window.location.hash.indexOf("no-right-panel") != -1) {
            $("#vvveb-builder").addClass("no-right-panel");
            $(".component-properties-tab").show();
            Vvveb.Components.componentPropertiesElement = "#left-panel .component-properties";
        } else {
            $(".component-properties-tab").hide();
        }

        Vvveb.Builder.init('<?= Yii::$app->Options->BackendUrl ?>/pages/widget/sample?page=<?= !empty($model->id) ? $model->id : 'new' ?>', function () {
            //run code after page/iframe is loaded
        });

        Vvveb.Gui.init();
        Vvveb.FileManager.init();
        // Vvveb.FileManager.addPages(pages);
        // Vvveb.FileManager.loadPage("currentPage");
        tippy('[data-toggle="tooltip"]');
    });
</script>

<script>
    <?php
    echo <<<JS
{$cGroup}
{$jsComponent}
JS;

    ?>
</script>


<!-- Forms -->
<?php
$componentFile = '';
// < Forms >
{
    $forms = \YiiMan\YiiBasics\modules\form\models\Form::find()->all();
    if (!empty($forms)) {

        $pCG = '';//parameters components group
        $pc = '';// parameters components properties
        $idc = uniqid();

        $pCG = 'Vvveb.ComponentsGroup[\'فرم ها\'] = [';//forms components group
        foreach ($forms as $name => $component) {
            $attribute = trim(str_replace(
                [
                    ' ',
                    '\'',
                    '\\',
                    '/',
                    '_',
                    '-',
                    '.',
                    '@',
                    '!',
                    '~',
                    '#',
                    '$',
                    '%',
                    '^',
                    '&',
                    '*',
                    '(',
                    ')',
                    '+',
                    '=',
                    '|',
                    '`',
                    ',',
                    '?',
                    '"',
                    '[',
                    ']',
                    '>',
                    '<',
                ]
                , '', strtolower($component->title)));

            $properties = '';
            // < generate Group variable >
            {
                $pCG .= '"'.$idc.'/'.$attribute.'",';

            }
            // </ generate Group variable >


            // < Generate Component >
            {

                $val = $component->details;


                $pc .= <<<JS
 
//Dont Change Html Format because Pars Will be lost
Vvveb.Components.extend("_base", "{$idc}/{$attribute}", {
    attributes: ["data-component-{$attribute}"],
    image: asseturlt + "libs/builder/" + "icons/registration-form.svg",
    html: `<SYSTEMPARAMETER name="form" data-component-{$attribute} id="form{$component->id}" idmodel="{$component->id}">{$component->title}: این پارامتر یک ویجت فرم در صفحه ایجاد میکند</SYSTEMPARAMETER>`,
    name: "{$attribute}",
    description:"",
    properties: [],
    afterDrop:function(){
        
        var code =$($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('#form{$component->id}');
         document.getElementById("form{$component->id}");
        console.log("form{$component->id}");
        console.log(code);
        var formData =
            `{$component->details}`;

  // Grab markup and escape it
        var markup = $("<div/>");
        markup.formRender({ formData });

  // set < code > innerText with escaped markup
        code.html( markup.formRender("html")) ;

    }
});   

JS;

            }
            // </ Generate Component >

        }
        $pCG .= '];';

        ?>
        <script>
            <?= $pCG ?>
            <?= $pc ?>
            <?= $componentFile ?>
        </script>
        <?php
    }
}
// </ Forms >

?>



<?php
$componentFile = '';
if (!empty(file_exists(Yii::getAlias('@vendor/yiiman/yii-basics/src/theme/builder/components.js')))) {
    $componentFile = file_get_contents(Yii::getAlias('@vendor/yiiman/yii-basics/src/theme/builder/components.js'));
}

$parameters = \YiiMan\YiiBasics\modules\parameters\models\Parameters::getAllParameters(true);
$pCG = '';//parameters components group
$pc = '';// parameters components properties
$idc = uniqid();
if (!empty($parameters)) {
    $pCG = 'Vvveb.ComponentsGroup[\'پارامترهای داینامیک\'] = [';//parameters components group
    foreach ($parameters as $name => $component) {
        if (!empty($component['private'])) {
            continue;
        }

        $properties = '';
        // < generate Group variable >
        {
            $pCG .= '"'.$idc.'/'.$name.'",';

        }
        // </ generate Group variable >


        // < Generate Component >
        {
            $properties = 'properties: [';
            $attributes = '';
            if (!empty($component['function'])) {

                foreach ($component['fields'] as $k => $f) {
                    $key = $k;
                    $attributes .= ' '.$key.'="'.$key.'"';

                    $mode = ucfirst($f['mode']);
                    $validValues = '';
                    $data = '
                
                ';
                    switch ($mode) {
                        case 'Select':
                        case 'Radio':
                            if (!empty($f['values'])) {
                                $validValues = 'validValues: [';
                                $data = 'data: {
                            options: [';
                                foreach ($f['values'] as $vk => $vv) {
                                    $validValues .= '"'.$vk.'",';
                                    $data .= '{
                        value: "'.$vk.'",
                        text: "'.$vv.'"
                    },';
                                }
                                $validValues .= '],';
                                $data .= ']
            },';
                            }
                            break;
                    }

                    $properties .= <<<JSON
{
            name: "{$f['label']}",
            key: "{$key}",
            htmlAttr: "{$k}",
            description:"{$f['hint']}",
            inputtype: {$mode}Input,
            {$validValues}
            {$data}
        },
JSON;

                }

            }

            $val = is_callable($component['val']) ? $name : $component['val'];
            $attribute = strtolower($name);
            $properties .= '],';
            $pc .= <<<JS

//Dont Change Html Format because Pars Will be lost
Vvveb.Components.extend("_base", "{$idc}/{$name}", {
    attributes: ["data-component-{$attribute}"],
    image: asseturlt + "libs/builder/" + "icons/three-dimensional.svg",
    html: `<SYSTEMPARAMETER name="{$name}" data-component-{$attribute}  {$attributes}>{$val}</SYSTEMPARAMETER>`,
    name: "{$name}",
    description:"{$component['description']}",
    {$properties}
});   

JS;

        }
        // </ Generate Component >

    }
    $pCG .= '];';
}

?>
<script>
    <?= $pCG ?>
    <?= $pc ?>
    <?= $componentFile ?>
</script>


<!-- components-->
<script src="<?= $assets->baseUrl ?>/libs/builder/components-bootstrap4.js?ver=<?= Yii::$app->Develop->assetVersion() ?>"></script>
<script src="<?= $assets->baseUrl ?>/libs/builder/components-widgets.js?ver=<?= Yii::$app->Develop->assetVersion() ?>"></script>

<!-- blocks-->
<script src="<?= $assets->baseUrl ?>/libs/builder/blocks-bootstrap4.js?ver=<?= Yii::$app->Develop->assetVersion() ?>"></script>

<script>
    $(document).ready(function () {
        var slugok = true;
        var isokInJs = true;
        $('#slug').on('focusout', function (e) {
            isokInJs = true;
            let value = $(this).val();
            if (value.length === 0) {
                $('#slughinthelp').empty();
            }
            var data = {slug: value};
            let str = value;
            let arr = str.split("");

            $.each(arr, function (index, char) {

                if ($.inArray(char, [' ', '-', '.', '/', '&', '$', '%', '^', '!', "#", "~", "`", '<', '>', '|', '{', '}', '[', ']', '?', ':', '"', '*', '=', '@', '(', ')']) > -1) {
                    console.log('error');
                    $('#slughinthelp').html('<span style="color: red">نمیتوانید از این کاراکتر ها استفاده کنید:    -   .   /   \   &   $   %   ^   !   #   ~   `   (   )   =   +   *   @   ; , " \' <> _  | [] {} ? : </span>');
                    isokInJs = false;
                    return false;
                } else {
                    isokInJs = true;
                }
            });

            if (isokInJs) {
                $.ajax({
                    url: '<?= Yii::$app->Options->BackendUrl; ?>/slug/default/check',
                    type: 'post',
                    data: data,
                    beforeSend: function (data) {

                    }
                }).done(function (data) {

                    $('#slughinthelp').html(data.message);
                    if (data.status == 'success') {
                        slugok = true;
                    } else {
                        slugok = false;
                    }
                });
            }


        });
        $('.modal-submit , #save-btn').click(function (e) {
            if (!slugok) {
                e.preventDefault();
                swal('لطفا یک نامک صحیح برای برگه انتخاب کنید');
            }
        });


        // < Background Upload File >
        {
            $('#backgroundFile').on('change', function (e) {
                console.log('changed');
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                    //reader.readAsBinaryString(this.files[0]);
                    file = this.files[0];
                }

                function imageIsLoaded(e) {

                    image = e.target.result;


                    //return;//remove this line to enable php upload

                    var formData = new FormData();
                    formData.append("file", file);

                    $.ajax({
                        type: "POST",
                        url: uploadUrl,//set your server side upload script url
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {

                            //update src input
                            try {
                                $('#fileBack').val(data);
                                $('#imageBack').attr('src', data);
                                $('#imageBack').show();

                            } catch (e) {

                            }

                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                }
            });
        }
        // </ Background Upload File >
    });
</script>


</body>
</html>
