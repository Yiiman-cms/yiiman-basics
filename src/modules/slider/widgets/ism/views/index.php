<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @var $this \YiiMan\YiiBasics\lib\View
 */


// < js >
{
    $js = <<<JS
 window.ISM = window.ISM || {};
    window.ISM.Config = window.ISM.Config || {no_instantiation:true};
JS;

    $this->registerJs($js, $this::POS_END);
    $this->registerJs($this->render('files/vendors.js'), $this::POS_END);
    $this->registerJs($this->render('files/ismjs.js'), $this::POS_END);
    $this->registerJs($this->render('files/ismgen.js'), $this::POS_END);


    $js = <<<JS
$(document).on("pagecreate", function() {
        //console.log(window.ISM.Slider);
        if(window.ISM.Slider && window.ISMGen)
        {
          var ism_slider = new ISM.Slider("my-slider", {
            // default options
            prevent_stop_loading: true
          });
          var ism_gen = new ISMGen(ism_slider, {
          });
          //console.log("OK");
        }
        else
        {
          $("#page-load-error-message").show();
        }
      });
JS;

    $this->registerJs($js, $this::POS_END);
}
// </ js >


// < css >
{
    $this->registerCss($this->render('files/style.css'));
}
// </ css >
?>
<div class="ui-mobile wf-loading">
    <div class="ui-mobile-viewport ui-overlay-a">
        <div data-role="page" data-url="/v2" tabindex="0" class="ui-page ui-page-theme-a ui-page-active" style="">
            <div class="ui-page ui-page-theme-a ui-page-active">
                <div class="row">
                    <div class="wrap">

                        <div class="slider-preview-container">

                            <div class="ism-slider" id="my-slider">
                                <div class="ism-frame">
                                    <ol class="ism-slides"
                                        style="width: 300%; perspective: 1000px; backface-visibility: hidden; transform: translateX(0px);">
                                        <li class="ism-slide ism-slide-0" style="width: 33.3333%; left: 0%;">
                                            <div class="ism-img-frame"><img src="/images/folio/slider/1.jpg"
                                                                            alt="Slide 1 - Flower" class="ism-img">
                                            </div>
                                            <div class="ism-caption ism-caption-0 ism-caption-anim"
                                                 style="visibility: visible;">My slide caption text
                                            </div>
                                        </li>
                                        <li class="ism-slide ism-slide-1" style="width: 33.3333%; left: 33.3333%;">
                                            <div class="ism-img-frame"><img src="/images/folio/slider/2.jpg"
                                                                            alt="Slide 2 - Another flower"
                                                                            class="ism-img"></div>
                                            <div class="ism-caption ism-caption-0" style="visibility:hidden;">My slide
                                                caption text
                                            </div>
                                        </li>
                                        <li class="ism-slide ism-slide-2" style="width: 33.3333%; left: 66.6667%;">
                                            <div class="ism-img-frame"><img src="/images/folio/slider/3.jpg"
                                                                            alt="Slide 3 - Field and blue sky"
                                                                            class="ism-img"></div>
                                            <div class="ism-caption ism-caption-0" style="visibility:hidden;">My slide
                                                caption text
                                            </div>
                                        </li>
                                    </ol>
                                    <div class="ism-button ism-button-prev">&nbsp;</div>
                                    <div class="ism-button ism-button-next">&nbsp;</div>
                                </div>
                                <ul class="ism-radios">
                                    <li class="ism-radio-0 active"><input type="radio" name="ism-radio"
                                                                          class="ism-radio" id="ism-radio-0"
                                                                          checked="checked"><label
                                                class="ism-radio-label" for="ism-radio-0"></label></li>
                                    <li class="ism-radio-1"><input type="radio" name="ism-radio" class="ism-radio"
                                                                   id="ism-radio-1"><label class="ism-radio-label"
                                                                                           for="ism-radio-1"></label>
                                    </li>
                                    <li class="ism-radio-2"><input type="radio" name="ism-radio" class="ism-radio"
                                                                   id="ism-radio-2"><label class="ism-radio-label"
                                                                                           for="ism-radio-2"></label>
                                    </li>
                                </ul>
                            </div>

                        </div> <!-- end of slider-preview-container -->

                        <div class="tool-container">

                            <div class="look-and-feel-controls">
                                <div class="col col-1-3 col-1">

                                    <div class="control-field control-field-slide-index">
                                        <div class="col col-2-3 slide-buttons-container">
                                            <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true"
                                                      class="slide-change-buttons-1-5 ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                <div class="ui-controlgroup-controls ">
                                                    <div class="ui-radio ui-mini"><label for="slide-index-0"
                                                                                         class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-first-child">1</label><input
                                                                type="radio" name="slide-index" id="slide-index-0"
                                                                value="0" checked="checked"></div>

                                                    <div class="ui-radio ui-mini"><label for="slide-index-1"
                                                                                         class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off">2</label><input
                                                                type="radio" name="slide-index" id="slide-index-1"
                                                                value="1"></div>

                                                    <div class="ui-radio ui-mini"><label for="slide-index-2"
                                                                                         class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child">3</label><input
                                                                type="radio" name="slide-index" id="slide-index-2"
                                                                value="2"></div>

                                                    <div class="ui-radio ui-mini" style="display: none;"><label
                                                                for="slide-index-3"
                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off">4</label><input
                                                                type="radio" name="slide-index" id="slide-index-3"
                                                                value="3"></div>

                                                    <div class="ui-radio ui-mini" style="display: none;"><label
                                                                for="slide-index-4"
                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off">5</label><input
                                                                type="radio" name="slide-index" id="slide-index-4"
                                                                value="4"></div>

                                                </div>
                                            </fieldset>
                                            <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true"
                                                      style="display:none;"
                                                      class="slide-change-buttons-6-10 ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                <div class="ui-controlgroup-controls ">
                                                    <div class="ui-radio ui-mini" style="display: none;"><label
                                                                for="slide-index-5"
                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-first-child">6</label><input
                                                                type="radio" name="slide-index" id="slide-index-5"
                                                                value="5"></div>

                                                    <div class="ui-radio ui-mini" style="display: none;"><label
                                                                for="slide-index-6"
                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off">7</label><input
                                                                type="radio" name="slide-index" id="slide-index-6"
                                                                value="6"></div>

                                                    <div class="ui-radio ui-mini" style="display: none;"><label
                                                                for="slide-index-7"
                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off">8</label><input
                                                                type="radio" name="slide-index" id="slide-index-7"
                                                                value="7"></div>

                                                    <div class="ui-radio ui-mini" style="display: none;"><label
                                                                for="slide-index-8"
                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off">9</label><input
                                                                type="radio" name="slide-index" id="slide-index-8"
                                                                value="8"></div>

                                                    <div class="ui-radio ui-mini" style="display: none;"><label
                                                                for="slide-index-9"
                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child">10</label><input
                                                                type="radio" name="slide-index" id="slide-index-9"
                                                                value="9"></div>

                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col col-1-3">
                                            <div class="control-field control-field-slide-add-remove ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini"
                                                 data-role="controlgroup" data-type="horizontal" data-mini="true">
                                                <div class="ui-controlgroup-controls ">
                                                    <a data-role="button" href="#"
                                                       class="slide-remove-button ui-link ui-btn ui-shadow ui-corner-all ui-first-child"
                                                       role="button"><span class="icon icon-16 icon-slide-remove"
                                                                           title="remove slide">&nbsp;</span></a>
                                                    <a data-role="button" href="#"
                                                       class="slide-add-button ui-link ui-btn ui-shadow ui-corner-all ui-last-child"
                                                       role="button"><span class="icon icon-16 icon-slide-add"
                                                                           title="add slide">&nbsp;</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <!-- SLIDE TABS -->
                                    <div class="slide-image-caption-tabs">
                                        <div class="control-field control-field-slide-tabs">
                                            <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true"
                                                      class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                <div class="ui-controlgroup-controls ">
                                                    <div class="ui-radio ui-mini"><label for="slide-tab-image"
                                                                                         class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-first-child"><span
                                                                    class="icon icon-32x16 icon-bright icon-image-tab"
                                                                    title="image">&nbsp;</span></label><input
                                                                type="radio" name="slide-tab" id="slide-tab-image"
                                                                value="image" checked="checked"></div>

                                                    <div class="ui-radio ui-mini"><label for="slide-tab-caption-0"
                                                                                         class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                    class="icon icon-32x16 icon-caption-tab-1"
                                                                    title="caption 1">&nbsp;</span></label><input
                                                                type="radio" name="slide-tab" id="slide-tab-caption-0"
                                                                value="caption-0" data-caption-index="0"></div>

                                                    <div class="ui-radio ui-mini"><label for="slide-tab-caption-1"
                                                                                         class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                    class="icon icon-32x16 icon-caption-tab-2"
                                                                    title="caption 2">&nbsp;</span></label><input
                                                                type="radio" name="slide-tab" id="slide-tab-caption-1"
                                                                value="caption-1" data-caption-index="1"></div>

                                                    <div class="ui-radio ui-mini"><label for="slide-tab-caption-2"
                                                                                         class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                    class="icon icon-32x16 icon-caption-tab-3"
                                                                    title="caption 3">&nbsp;</span></label><input
                                                                type="radio" name="slide-tab" id="slide-tab-caption-2"
                                                                value="caption-2" data-caption-index="2"></div>

                                                </div>
                                            </fieldset>
                                        </div>
                                        <a class="help ui-link" href="#doc-slides"
                                           title="Learn how to edit, add and remove slides." data-ajax="false">?</a>
                                    </div>

                                    <div class="controls-group controls-group-slides">

                                        <div class="slide-image-tab-content">
                                            <!-- IMAGE POSITIONING -->
                                            <div class="control-field-image-positioning">
                                                <div class="col col-1-5">
                                                    <div class="control-field">
                                                        <fieldset data-role="controlgroup" data-type="vertical"
                                                                  data-mini="true"
                                                                  class="ui-controlgroup ui-controlgroup-vertical ui-corner-all ui-mini">
                                                            <div role="heading" class="ui-controlgroup-label">
                                                                <legend>Image Fit</legend>
                                                            </div>
                                                            <div class="ui-controlgroup-controls ">

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="slide-image-fit-width"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"><span
                                                                                class="icon icon-16 icon-image-fit-width"
                                                                                title="fit image to slider width">&nbsp;</span></label><input
                                                                            type="radio" name="slide-image-fit"
                                                                            id="slide-image-fit-width" value="width"
                                                                            checked="checked"></div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="slide-image-fit-height"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off"><span
                                                                                class="icon icon-16 icon-image-fit-height"
                                                                                title="fit image to slider height">&nbsp;</span></label><input
                                                                            type="radio" name="slide-image-fit"
                                                                            id="slide-image-fit-height" value="height">
                                                                </div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="slide-image-fit-stretch"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off ui-last-child"><span
                                                                                class="icon icon-16 icon-image-fit-stretch"
                                                                                title="stretch image to slider width and height">&nbsp;</span></label><input
                                                                            type="radio" name="slide-image-fit"
                                                                            id="slide-image-fit-stretch"
                                                                            value="stretch"></div>

                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="col col-3-5">
                                                    <div class="control-field">
                                                        <div class="slide-image-positioner">
                                                            <img src="https://imageslidermaker.com/ism/image/slides/flower-729514_1280.jpg"
                                                                 style="width: 80px; top: 24.75px; left: 30px;">
                                                            <div class="image-frame"
                                                                 style="width: 80px; height: 20px; top: 40px; left: 30px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col col-1-5">
                                                    <div class="control-field control-field-slide-image-align">
                                                        <fieldset data-role="controlgroup" data-type="vertical"
                                                                  data-mini="true"
                                                                  class="ui-controlgroup ui-controlgroup-vertical ui-corner-all ui-mini">
                                                            <div role="heading" class="ui-controlgroup-label">
                                                                <legend>Image Align</legend>
                                                            </div>
                                                            <div class="ui-controlgroup-controls ">

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="slide-image-align-start"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off ui-first-child"><span
                                                                                class="icon icon-16 icon-image-align-top"
                                                                                title="align start">&nbsp;</span></label><input
                                                                            type="radio" name="slide-image-align"
                                                                            id="slide-image-align-start" value="start">
                                                                </div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="slide-image-align-middle"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on"><span
                                                                                class="icon icon-16 icon-image-align-middle"
                                                                                title="align middle">&nbsp;</span></label><input
                                                                            type="radio" name="slide-image-align"
                                                                            id="slide-image-align-middle" value="middle"
                                                                            checked="checked"></div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="slide-image-align-end"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off ui-last-child"><span
                                                                                class="icon icon-16 icon-image-align-bottom"
                                                                                title="align end">&nbsp;</span></label><input
                                                                            type="radio" name="slide-image-align"
                                                                            id="slide-image-align-end" value="end">
                                                                </div>

                                                            </div>
                                                        </fieldset>

                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>

                                            <!-- IMAGE SELECTION -->
                                            <div class="control-field-image-selection">
                                                <div>

                                                    <div class="imageselect-upload">
                                                        <div class="col col-2-5">
                        <span id="imageselect-upload-button" class="fileinput-button ui-btn ui-mini ui-corner-all">
                          <i class="icon-upload"></i>
                          <span><span class="icon icon-16 icon-upload" title="upload">&nbsp;</span>Upload</span>
                          <input data-role="none" id="fileupload" type="file" name="files[]" multiple="">
                        </span>
                                                        </div>
                                                        <div class="col col-3-5">
                                                            <div id="progress">
                                                                <div class="bar" style="width: 0%;"></div>
                                                            </div>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>

                                                    <button id="dummy-upload-button" type="button" data-disabled="true"
                                                            style="display:none;"
                                                            class=" ui-btn ui-shadow ui-corner-all">
                                                        <strike>Upload</strike></button>
                                                    <p class="cookie-warning" style="display:none;">Cookies must be
                                                        enabled</p>

                                                </div>
                                                <div class="image-selection-items">
                                                    <ul class="user-images"></ul>
                                                    <ul class="library-images">


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/above-736879_1280.jpg"
                                                                                          data-index="0"
                                                                                          style="background-position: 0px 0px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/aircraft-479772_1280.jpg"
                                                                                          data-index="1"
                                                                                          style="background-position: -80px 0px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/amazing-701679_1280.jpg"
                                                                                          data-index="2"
                                                                                          style="background-position: -160px 0px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/architecture-22039_1280.jpg"
                                                                                          data-index="3"
                                                                                          style="background-position: -240px 0px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/background-2276_1280.jpg"
                                                                                          data-index="4"
                                                                                          style="background-position: 0px -54px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/background-2561_1280.jpg"
                                                                                          data-index="5"
                                                                                          style="background-position: -80px -54px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/bananas-698608_1280.jpg"
                                                                                          data-index="6"
                                                                                          style="background-position: -160px -54px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/barley-373360_1280.jpg"
                                                                                          data-index="7"
                                                                                          style="background-position: -240px -54px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/beach-hut-237489_1280.jpg"
                                                                                          data-index="8"
                                                                                          style="background-position: 0px -108px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/beautiful-701678_1280.jpg"
                                                                                          data-index="9"
                                                                                          style="background-position: -80px -108px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/biker-384920_1280.jpg"
                                                                                          data-index="10"
                                                                                          style="background-position: -160px -108px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/bl_15826.jpg"
                                                                                          data-index="11"
                                                                                          style="background-position: -240px -108px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/bl_16510.jpg"
                                                                                          data-index="12"
                                                                                          style="background-position: 0px -162px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/bl_310.jpg"
                                                                                          data-index="13"
                                                                                          style="background-position: -80px -162px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/bokeh-715283_1280.jpg"
                                                                                          data-index="14"
                                                                                          style="background-position: -160px -162px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/bora-bora-685303_1280.jpg"
                                                                                          data-index="15"
                                                                                          style="background-position: -240px -162px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/bora-bora-701857_1280.jpg"
                                                                                          data-index="16"
                                                                                          style="background-position: 0px -216px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/border-collie-667488_1280.jpg"
                                                                                          data-index="17"
                                                                                          style="background-position: -80px -216px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/br_2225.jpg"
                                                                                          data-index="18"
                                                                                          style="background-position: -160px -216px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/budapest-655216_1280.jpg"
                                                                                          data-index="19"
                                                                                          style="background-position: -240px -216px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/butterfly-730430_1280.jpg"
                                                                                          data-index="20"
                                                                                          style="background-position: 0px -270px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/car-604019_1280.jpg"
                                                                                          data-index="21"
                                                                                          style="background-position: -80px -270px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/central-park-142894_1280.jpg"
                                                                                          data-index="22"
                                                                                          style="background-position: -160px -270px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/chain-690088_1280.jpg"
                                                                                          data-index="23"
                                                                                          style="background-position: -240px -270px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/chainlink-690503_1280.jpg"
                                                                                          data-index="24"
                                                                                          style="background-position: 0px -324px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/chicago-690364_1280.jpg"
                                                                                          data-index="25"
                                                                                          style="background-position: -80px -324px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/chioggia-571381_1280.jpg"
                                                                                          data-index="26"
                                                                                          style="background-position: -160px -324px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/city-647400_1280.jpg"
                                                                                          data-index="27"
                                                                                          style="background-position: -240px -324px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/city-690332_1280.jpg"
                                                                                          data-index="28"
                                                                                          style="background-position: 0px -378px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/city-691279_1280.jpg"
                                                                                          data-index="29"
                                                                                          style="background-position: -80px -378px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/city-698616_1280.jpg"
                                                                                          data-index="30"
                                                                                          style="background-position: -160px -378px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/coastal-landscape-356767_1280.jpg"
                                                                                          data-index="31"
                                                                                          style="background-position: -240px -378px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/colored-pencils-686679_1280.jpg"
                                                                                          data-index="32"
                                                                                          style="background-position: 0px -432px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/cube-689618_1280.jpg"
                                                                                          data-index="33"
                                                                                          style="background-position: -80px -432px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/cycling-655565_1280.jpg"
                                                                                          data-index="34"
                                                                                          style="background-position: -160px -432px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/dinner-table-663435_1280.jpg"
                                                                                          data-index="35"
                                                                                          style="background-position: -240px -432px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/dirt-bike-690770_1280.jpg"
                                                                                          data-index="36"
                                                                                          style="background-position: 0px -486px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/divers-681516_1280.jpg"
                                                                                          data-index="37"
                                                                                          style="background-position: -80px -486px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/document-428331_1280.jpg"
                                                                                          data-index="38"
                                                                                          style="background-position: -160px -486px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/document-428338_1280.jpg"
                                                                                          data-index="39"
                                                                                          style="background-position: -240px -486px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/earth-11009_1280.jpg"
                                                                                          data-index="40"
                                                                                          style="background-position: 0px -540px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/eat-321671_1280.jpg"
                                                                                          data-index="41"
                                                                                          style="background-position: -80px -540px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/entrepreneur-593358_1280.jpg"
                                                                                          data-index="42"
                                                                                          style="background-position: -160px -540px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/euro-163475_1280.jpg"
                                                                                          data-index="43"
                                                                                          style="background-position: -240px -540px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/flame-726268_1280.jpg"
                                                                                          data-index="44"
                                                                                          style="background-position: 0px -594px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/flower-729514_1280.jpg"
                                                                                          data-index="45"
                                                                                          style="background-position: -80px -594px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/font-705667_1280.jpg"
                                                                                          data-index="46"
                                                                                          style="background-position: -160px -594px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/girl-429380_1280.jpg"
                                                                                          data-index="47"
                                                                                          style="background-position: -240px -594px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/girls-685787_1280.jpg"
                                                                                          data-index="48"
                                                                                          style="background-position: 0px -648px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/gold-163519_1280.jpg"
                                                                                          data-index="49"
                                                                                          style="background-position: -80px -648px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/golden-gate-bridge-388917_1280.jpg"
                                                                                          data-index="50"
                                                                                          style="background-position: -160px -648px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/gr_1903.jpg"
                                                                                          data-index="51"
                                                                                          style="background-position: -240px -648px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/gr_22057.jpg"
                                                                                          data-index="52"
                                                                                          style="background-position: 0px -702px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/gr_23551.jpg"
                                                                                          data-index="53"
                                                                                          style="background-position: -80px -702px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/gr_41495.jpg"
                                                                                          data-index="54"
                                                                                          style="background-position: -160px -702px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/green-654402_1280.jpg"
                                                                                          data-index="55"
                                                                                          style="background-position: -240px -702px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/hands-600497_1280.jpg"
                                                                                          data-index="56"
                                                                                          style="background-position: 0px -756px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/harley-davidson-459594_1280.jpg"
                                                                                          data-index="57"
                                                                                          style="background-position: -80px -756px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/hawker-539490_1280.jpg"
                                                                                          data-index="58"
                                                                                          style="background-position: -160px -756px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/home-office-336373_1280.jpg"
                                                                                          data-index="59"
                                                                                          style="background-position: -240px -756px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/home-office-336377_1280.jpg"
                                                                                          data-index="60"
                                                                                          style="background-position: 0px -810px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/lamborghini-593105_1280.jpg"
                                                                                          data-index="61"
                                                                                          style="background-position: -80px -810px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/lamborghini-618356_1280.jpg"
                                                                                          data-index="62"
                                                                                          style="background-position: -160px -810px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/lion-721836_1280.jpg"
                                                                                          data-index="63"
                                                                                          style="background-position: -240px -810px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/machu-pichu-639174_1280.jpg"
                                                                                          data-index="64"
                                                                                          style="background-position: 0px -864px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/mars-67522_1280.jpg"
                                                                                          data-index="65"
                                                                                          style="background-position: -80px -864px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/mirroring-711926_1280.jpg"
                                                                                          data-index="66"
                                                                                          style="background-position: -160px -864px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/mobile-616012_1280.jpg"
                                                                                          data-index="67"
                                                                                          style="background-position: -240px -864px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/money-256281_1280.jpg"
                                                                                          data-index="68"
                                                                                          style="background-position: 0px -918px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/money-93206_1280.jpg"
                                                                                          data-index="69"
                                                                                          style="background-position: -80px -918px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/moon-landing-60582_1280.jpg"
                                                                                          data-index="70"
                                                                                          style="background-position: -160px -918px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/moorea-681289_1280.jpg"
                                                                                          data-index="71"
                                                                                          style="background-position: -240px -918px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/mosque-615415_1280.jpg"
                                                                                          data-index="72"
                                                                                          style="background-position: 0px -972px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/mother-board-581597_1280.jpg"
                                                                                          data-index="73"
                                                                                          style="background-position: -80px -972px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/motorbike-407186_1280.jpg"
                                                                                          data-index="74"
                                                                                          style="background-position: -160px -972px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/motorcycle-293571_1280.jpg"
                                                                                          data-index="75"
                                                                                          style="background-position: -240px -972px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/motorcycle-racer-597913_1280.jpg"
                                                                                          data-index="76"
                                                                                          style="background-position: 0px -1026px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/mountains-392669_1280.jpg"
                                                                                          data-index="77"
                                                                                          style="background-position: -80px -1026px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/needle-672396_1280.jpg"
                                                                                          data-index="78"
                                                                                          style="background-position: -160px -1026px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/new-york-670108_1280.jpg"
                                                                                          data-index="79"
                                                                                          style="background-position: -240px -1026px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/new-york-city-78181_1280.jpg"
                                                                                          data-index="80"
                                                                                          style="background-position: 0px -1080px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/office-620822_1280.jpg"
                                                                                          data-index="81"
                                                                                          style="background-position: -80px -1080px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/or_1282.jpg"
                                                                                          data-index="82"
                                                                                          style="background-position: -160px -1080px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/or_565.jpg"
                                                                                          data-index="83"
                                                                                          style="background-position: -240px -1080px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/park-737228_1280.jpg"
                                                                                          data-index="84"
                                                                                          style="background-position: 0px -1134px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/pier-569314_1280.jpg"
                                                                                          data-index="85"
                                                                                          style="background-position: -80px -1134px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/plane-170272_1280.jpg"
                                                                                          data-index="86"
                                                                                          style="background-position: -160px -1134px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/pool-690034_1280.jpg"
                                                                                          data-index="87"
                                                                                          style="background-position: -240px -1134px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/pool-720697_1280.jpg"
                                                                                          data-index="88"
                                                                                          style="background-position: 0px -1188px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/railway-692337_640.jpg"
                                                                                          data-index="89"
                                                                                          style="background-position: -80px -1188px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/rainbow-lorikeet-686100_1280.jpg"
                                                                                          data-index="90"
                                                                                          style="background-position: -160px -1188px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/road-690087_1280.jpg"
                                                                                          data-index="91"
                                                                                          style="background-position: -240px -1188px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/rock-540130_1280.jpg"
                                                                                          data-index="92"
                                                                                          style="background-position: 0px -1242px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/rocket-launch-67643_1280.jpg"
                                                                                          data-index="93"
                                                                                          style="background-position: -80px -1242px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/salad-652503_1280.jpg"
                                                                                          data-index="94"
                                                                                          style="background-position: -160px -1242px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/sand-dunes-691431_1280.jpg"
                                                                                          data-index="95"
                                                                                          style="background-position: -240px -1242px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/sea-701079_1280.jpg"
                                                                                          data-index="96"
                                                                                          style="background-position: 0px -1296px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/seagull-487726_1280.jpg"
                                                                                          data-index="97"
                                                                                          style="background-position: -80px -1296px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/shish-kebab-417994_1280.jpg"
                                                                                          data-index="98"
                                                                                          style="background-position: -160px -1296px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/singapore-431421_1280.jpg"
                                                                                          data-index="99"
                                                                                          style="background-position: -240px -1296px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/singapore-river-255116_1280.jpg"
                                                                                          data-index="100"
                                                                                          style="background-position: 0px -1350px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/sky-690293_1280.jpg"
                                                                                          data-index="101"
                                                                                          style="background-position: -80px -1350px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/skydiving-678168_1280.jpg"
                                                                                          data-index="102"
                                                                                          style="background-position: -160px -1350px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/smartphone-431230_1280.jpg"
                                                                                          data-index="103"
                                                                                          style="background-position: -240px -1350px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/smartphone-623722_1280.jpg"
                                                                                          data-index="104"
                                                                                          style="background-position: 0px -1404px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/smartphone-695164_1280.jpg"
                                                                                          data-index="105"
                                                                                          style="background-position: -80px -1404px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/soldier-708711_1280.jpg"
                                                                                          data-index="106"
                                                                                          style="background-position: -160px -1404px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/sparkler-677774_1280.jpg"
                                                                                          data-index="107"
                                                                                          style="background-position: -240px -1404px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/spike-8743_1280.jpg"
                                                                                          data-index="108"
                                                                                          style="background-position: 0px -1458px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/statue-of-liberty-267948_1280.jpg"
                                                                                          data-index="109"
                                                                                          style="background-position: -80px -1458px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/stock-624712_1280.jpg"
                                                                                          data-index="110"
                                                                                          style="background-position: -160px -1458px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/stop-634941_1280.jpg"
                                                                                          data-index="111"
                                                                                          style="background-position: -240px -1458px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/strawberries-272812_1280.jpg"
                                                                                          data-index="112"
                                                                                          style="background-position: 0px -1512px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/summer-192179_1280.jpg"
                                                                                          data-index="113"
                                                                                          style="background-position: -80px -1512px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/sunset-86214_1280.jpg"
                                                                                          data-index="114"
                                                                                          style="background-position: -160px -1512px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/taxi-cab-381233_1280.jpg"
                                                                                          data-index="115"
                                                                                          style="background-position: -240px -1512px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/telephone-586268_1280.jpg"
                                                                                          data-index="116"
                                                                                          style="background-position: 0px -1566px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/tiger-655593_1280.jpg"
                                                                                          data-index="117"
                                                                                          style="background-position: -80px -1566px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/tomato-663097_1280.jpg"
                                                                                          data-index="118"
                                                                                          style="background-position: -160px -1566px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/tomatoes-5356_1280.jpg"
                                                                                          data-index="119"
                                                                                          style="background-position: -240px -1566px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/tomatoes-73913_1280.jpg"
                                                                                          data-index="120"
                                                                                          style="background-position: 0px -1620px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/toronto-698496_1280.jpg"
                                                                                          data-index="121"
                                                                                          style="background-position: -80px -1620px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/traffic-691870_1280.jpg"
                                                                                          data-index="122"
                                                                                          style="background-position: -160px -1620px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/tree-701688_1280.jpg"
                                                                                          data-index="123"
                                                                                          style="background-position: -240px -1620px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/tree-701692_1280.jpg"
                                                                                          data-index="124"
                                                                                          style="background-position: 0px -1674px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/tree-736887_1280.jpg"
                                                                                          data-index="125"
                                                                                          style="background-position: -80px -1674px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/tulips-708410_1280.jpg"
                                                                                          data-index="126"
                                                                                          style="background-position: -160px -1674px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/wh_11696.jpg"
                                                                                          data-index="127"
                                                                                          style="background-position: -240px -1674px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/wh_22125.jpg"
                                                                                          data-index="128"
                                                                                          style="background-position: 0px -1728px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/wh_45752.jpg"
                                                                                          data-index="129"
                                                                                          style="background-position: -80px -1728px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/white-tailed-eagle-660907_1280.jpg"
                                                                                          data-index="130"
                                                                                          style="background-position: -160px -1728px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/woman-506120_1280.jpg"
                                                                                          data-index="131"
                                                                                          style="background-position: -240px -1728px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/woman-731887_1280.jpg"
                                                                                          data-index="132"
                                                                                          style="background-position: 0px -1782px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/woodland-656969_1280.jpg"
                                                                                          data-index="133"
                                                                                          style="background-position: -80px -1782px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/ye_10593.jpg"
                                                                                          data-index="134"
                                                                                          style="background-position: -160px -1782px;"></span>
                                                        </li>


                                                        <li class="selectable-item"><span class="img"
                                                                                          data-src="/ism/image/thumbnails/ye_25419.jpg"
                                                                                          data-index="135"
                                                                                          style="background-position: -240px -1782px;"></span>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>

                                            <!-- IMAGE LINK -->
                                            <div class="control-field-image-link">

                                                <div class="col col-2-3">
                                                    <div class="control-field">
                                                        <fieldset data-role="controlgroup" data-type="horizontal"
                                                                  data-mini="true"
                                                                  class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                            <div role="heading" class="ui-controlgroup-label">
                                                                <legend>Image Link Target</legend>
                                                            </div>
                                                            <div class="ui-controlgroup-controls ">

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="image-link-target-none"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-first-child"><span
                                                                                class="icon icon-16 icon-link-none"
                                                                                title="no link">&nbsp;</span></label><input
                                                                            type="radio" name="image-link-target"
                                                                            id="image-link-target-none" value="none"
                                                                            checked="checked"></div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="image-link-target-_self"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                                class="icon icon-16 icon-link"
                                                                                title="link">&nbsp;</span></label><input
                                                                            type="radio" name="image-link-target"
                                                                            id="image-link-target-_self" value="_self">
                                                                </div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="image-link-target-_blank"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                                class="icon icon-16 icon-link-new-tab"
                                                                                title="link - new tab">&nbsp;</span></label><input
                                                                            type="radio" name="image-link-target"
                                                                            id="image-link-target-_blank"
                                                                            value="_blank"></div>

                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="col col-1-3 help-tools help-tools-row">
                                                    <a class="help ui-link" href="#doc-slide-image"
                                                       title="Learn about slide image settings" data-ajax="false">?</a>
                                                </div>
                                                <div class="clear"></div>

                                                <div class="ui-input-text ui-shadow-inset mobile-textinput-disabled ui-body-inherit ui-corner-all ui-state-disabled">
                                                    <input type="text" name="image-link-href" id="image-link-href"
                                                           placeholder="http://" data-disabled="true" disabled=""></div>

                                            </div>
                                        </div>

                                        <!-- CAPTIONS -->
                                        <div class="controls-group-captions" style="display:none;">
                                            <div class="control-fields control-fields-tabbed caption-tabs ui-tabs ui-widget ui-widget-content ui-corner-all"
                                                 data-role="tabs">
                                                <div class="control-field">
                                                    <div class="col col-1-3">
                                                        <div class="ui-flipswitch ui-shadow-inset ui-bar-inherit ui-flipswitch-active ui-corner-all ui-mini">
                                                            <a href="#"
                                                               class="ui-flipswitch-on ui-btn ui-shadow ui-btn-inherit">On</a><span
                                                                    class="ui-flipswitch-off">Off</span><input
                                                                    type="checkbox" data-role="flipswitch"
                                                                    name="caption-enable" id="caption-enable"
                                                                    checked="checked" data-mini="true"
                                                                    class="ui-flipswitch-input" tabindex="-1"></div>
                                                    </div>
                                                    <div class="col col-2-3">
                                                        <div class="control-field control-field-disableable">
                                                            <fieldset data-role="controlgroup" data-type="horizontal"
                                                                      data-mini="true"
                                                                      class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                                <div role="heading" class="ui-controlgroup-label">
                                                                    <legend>Effect</legend>
                                                                </div>
                                                                <div class="ui-controlgroup-controls ">

                                                                    <div class="ui-radio ui-mini"><label
                                                                                for="caption-fx-fade"
                                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-first-child"><span
                                                                                    class="icon icon-16 icon-caption-fade-in"
                                                                                    title="fade in">&nbsp;</span></label><input
                                                                                type="radio" name="caption-fx"
                                                                                id="caption-fx-fade" value="fade"
                                                                                checked="checked"></div>

                                                                    <div class="ui-radio ui-mini"><label
                                                                                for="caption-fx-slide"
                                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                                    class="icon icon-16 icon-caption-slide"
                                                                                    title="slide">&nbsp;</span></label><input
                                                                                type="radio" name="caption-fx"
                                                                                id="caption-fx-slide" value="slide">
                                                                    </div>

                                                                    <div class="ui-radio ui-mini"><label
                                                                                for="caption-fx-pop"
                                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                                    class="icon icon-16 icon-caption-pop"
                                                                                    title="pop">&nbsp;</span></label><input
                                                                                type="radio" name="caption-fx"
                                                                                id="caption-fx-pop" value="pop"></div>

                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="control-field control-field-delay control-field-disableable">
                                                    <div class="col col-1-5">
                                                        <label for="caption-delay" class="caption-delay-label"
                                                               id="caption-delay-label"><span
                                                                    class="icon icon-16 icon-timer" title="delay (ms)">&nbsp;</span></label>
                                                    </div>
                                                    <div class="col col-4-5">
                                                        <div class="ui-slider"><input type="number" data-type="range"
                                                                                      name="caption-delay"
                                                                                      id="caption-delay" value="0"
                                                                                      min="0" max="3000" step="100"
                                                                                      class="ui-shadow-inset ui-body-inherit ui-corner-all ui-slider-input">
                                                            <div role="application"
                                                                 class="ui-slider-track ui-shadow-inset ui-bar-inherit ui-corner-all"
                                                                 aria-disabled="false"><a href="#"
                                                                                          class="ui-slider-handle ui-btn ui-shadow"
                                                                                          role="slider"
                                                                                          aria-valuemin="0"
                                                                                          aria-valuemax="3000"
                                                                                          aria-valuenow="0"
                                                                                          aria-valuetext="0" title="0"
                                                                                          aria-labelledby="caption-delay-label"
                                                                                          style="left: 0%;"></a></div>
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="col col-3-4">
                                                    <div class="control-field control-field-disableable">
                                                        <textarea data-clear-btn="true" name="caption-text"
                                                                  id="caption-text" placeholder="type caption text"
                                                                  style="font-family:'Titillium Web';"
                                                                  class="ui-input-text ui-shadow-inset ui-textinput-autogrow ui-body-inherit ui-corner-all">My slide caption text</textarea>
                                                    </div>
                                                </div>
                                                <div class="col col-1-4">
                                                    <div class="control-field control-field-disableable">
                                                        <div class="ui-btn ui-input-btn ui-corner-all ui-shadow ui-mini ui-icon-carat-d ui-btn-icon-bottom">
                                                            font<input type="button" name="font-toggle" value="font"
                                                                       data-mini="true" data-icon="carat-d"
                                                                       data-iconpos="bottom" class="font-toggle"></div>
                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                                <div class="font-panel font-panel-hidden">
                                                    <div class="control-field control-field-disableable">
                                                        <fieldset data-role="controlgroup" data-type="horizontal"
                                                                  data-mini="true"
                                                                  class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                            <div role="heading" class="ui-controlgroup-label">
                                                                <legend>Font Size</legend>
                                                            </div>
                                                            <div class="ui-controlgroup-controls ">

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-size-tiny"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-first-child"><span
                                                                                class="icon icon-16 icon-font-size-tiny"
                                                                                title="tiny">&nbsp;</span></label><input
                                                                            type="radio" name="caption-size"
                                                                            id="caption-size-tiny" value="tiny"></div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-size-small"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                                class="icon icon-16 icon-font-size-small"
                                                                                title="small">&nbsp;</span></label><input
                                                                            type="radio" name="caption-size"
                                                                            id="caption-size-small" value="small"></div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-size-medium"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active"><span
                                                                                class="icon icon-16 icon-font-size-medium"
                                                                                title="medium">&nbsp;</span></label><input
                                                                            type="radio" name="caption-size"
                                                                            id="caption-size-medium" value="medium"
                                                                            checked="checked"></div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-size-large"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                                class="icon icon-16 icon-font-size-large"
                                                                                title="large">&nbsp;</span></label><input
                                                                            type="radio" name="caption-size"
                                                                            id="caption-size-large" value="large"></div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-size-huge"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                                class="icon icon-16 icon-font-size-huge"
                                                                                title="huge">&nbsp;</span></label><input
                                                                            type="radio" name="caption-size"
                                                                            id="caption-size-huge" value="huge"></div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-size-massive"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                                class="icon icon-16 icon-font-size-massive"
                                                                                title="massive">&nbsp;</span></label><input
                                                                            type="radio" name="caption-size"
                                                                            id="caption-size-massive" value="massive">
                                                                </div>

                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="control-field control-field-disableable font-selection">
                                                        <fieldset data-role="controlgroup" data-type="vertical"
                                                                  data-mini="true"
                                                                  class="ui-controlgroup ui-controlgroup-vertical ui-corner-all ui-mini">
                                                            <div role="heading" class="ui-controlgroup-label">
                                                                <legend>Font</legend>
                                                            </div>
                                                            <div class="ui-controlgroup-controls ">


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-0"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">sans-serif
                                                                        (sans-serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-0"
                                                                                                   value="sans-serif"
                                                                                                   checked="checked">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-1"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Open
                                                                        Sans (sans-serif)</label><input type="radio"
                                                                                                        name="caption-font"
                                                                                                        id="caption-font-1"
                                                                                                        value="Open Sans">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-2"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Roboto
                                                                        (sans-serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-2"
                                                                                                   value="Roboto"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-3"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Lato
                                                                        (sans-serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-3"
                                                                                                   value="Lato"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-4"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Oswald
                                                                        (sans-serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-4"
                                                                                                   value="Oswald"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-5"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Roboto
                                                                        Condensed (sans-serif)</label><input
                                                                            type="radio" name="caption-font"
                                                                            id="caption-font-5"
                                                                            value="Roboto Condensed"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-6"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Source
                                                                        Sans Pro (sans-serif)</label><input type="radio"
                                                                                                            name="caption-font"
                                                                                                            id="caption-font-6"
                                                                                                            value="Source Sans Pro">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-7"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">PT
                                                                        Sans (sans-serif)</label><input type="radio"
                                                                                                        name="caption-font"
                                                                                                        id="caption-font-7"
                                                                                                        value="PT Sans">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-8"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Open
                                                                        Sans Condensed (sans-serif)</label><input
                                                                            type="radio" name="caption-font"
                                                                            id="caption-font-8"
                                                                            value="Open Sans Condensed"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-9"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Raleway
                                                                        (sans-serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-9"
                                                                                                   value="Raleway">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-10"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Droid
                                                                        Sans (sans-serif)</label><input type="radio"
                                                                                                        name="caption-font"
                                                                                                        id="caption-font-10"
                                                                                                        value="Droid Sans">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-11"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Montserrat
                                                                        (sans-serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-11"
                                                                                                   value="Montserrat">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-12"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Ubuntu
                                                                        (sans-serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-12"
                                                                                                   value="Ubuntu"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-13"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">PT
                                                                        Sans Narrow (sans-serif)</label><input
                                                                            type="radio" name="caption-font"
                                                                            id="caption-font-13" value="PT Sans Narrow">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-14"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Arimo
                                                                        (sans-serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-14"
                                                                                                   value="Arimo"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-15"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Noto
                                                                        Sans (sans-serif)</label><input type="radio"
                                                                                                        name="caption-font"
                                                                                                        id="caption-font-15"
                                                                                                        value="Noto Sans">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-16"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Yanone
                                                                        Kaffeesatz (sans-serif)</label><input
                                                                            type="radio" name="caption-font"
                                                                            id="caption-font-16"
                                                                            value="Yanone Kaffeesatz"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-17"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Titillium
                                                                        Web (sans-serif)</label><input type="radio"
                                                                                                       name="caption-font"
                                                                                                       id="caption-font-17"
                                                                                                       value="Titillium Web">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-18"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Oxygen
                                                                        (sans-serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-18"
                                                                                                   value="Oxygen"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-19"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Dosis
                                                                        (sans-serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-19"
                                                                                                   value="Dosis"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-20"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Cabin
                                                                        (sans-serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-20"
                                                                                                   value="Cabin"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-21"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">serif
                                                                        (serif)</label><input type="radio"
                                                                                              name="caption-font"
                                                                                              id="caption-font-21"
                                                                                              value="serif"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-22"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Lora
                                                                        (serif)</label><input type="radio"
                                                                                              name="caption-font"
                                                                                              id="caption-font-22"
                                                                                              value="Lora"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-23"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Droid
                                                                        Serif (serif)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-23"
                                                                                                    value="Droid Serif">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-24"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Roboto
                                                                        Slab (serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-24"
                                                                                                   value="Roboto Slab">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-25"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Merriweather
                                                                        (serif)</label><input type="radio"
                                                                                              name="caption-font"
                                                                                              id="caption-font-25"
                                                                                              value="Merriweather">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-26"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Bitter
                                                                        (serif)</label><input type="radio"
                                                                                              name="caption-font"
                                                                                              id="caption-font-26"
                                                                                              value="Bitter"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-27"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">PT
                                                                        Serif (serif)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-27"
                                                                                                    value="PT Serif">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-28"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Arvo
                                                                        (serif)</label><input type="radio"
                                                                                              name="caption-font"
                                                                                              id="caption-font-28"
                                                                                              value="Arvo"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-29"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Vollkorn
                                                                        (serif)</label><input type="radio"
                                                                                              name="caption-font"
                                                                                              id="caption-font-29"
                                                                                              value="Vollkorn"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-30"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Bree
                                                                        Serif (serif)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-30"
                                                                                                    value="Bree Serif">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-31"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Noto
                                                                        Serif (serif)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-31"
                                                                                                    value="Noto Serif">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-32"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Libre
                                                                        Baskerville (serif)</label><input type="radio"
                                                                                                          name="caption-font"
                                                                                                          id="caption-font-32"
                                                                                                          value="Libre Baskerville">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-33"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Rokkitt
                                                                        (serif)</label><input type="radio"
                                                                                              name="caption-font"
                                                                                              id="caption-font-33"
                                                                                              value="Rokkitt"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-34"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Alegreya
                                                                        (serif)</label><input type="radio"
                                                                                              name="caption-font"
                                                                                              id="caption-font-34"
                                                                                              value="Alegreya"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-35"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Crimson
                                                                        Text (serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-35"
                                                                                                   value="Crimson Text">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-36"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Crete
                                                                        Round (serif)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-36"
                                                                                                    value="Crete Round">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-37"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Sanchez
                                                                        (serif)</label><input type="radio"
                                                                                              name="caption-font"
                                                                                              id="caption-font-37"
                                                                                              value="Sanchez"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-38"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">EB
                                                                        Garamond (serif)</label><input type="radio"
                                                                                                       name="caption-font"
                                                                                                       id="caption-font-38"
                                                                                                       value="EB Garamond">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-39"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Josefin
                                                                        Slab (serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-39"
                                                                                                   value="Josefin Slab">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-40"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Noticia
                                                                        Text (serif)</label><input type="radio"
                                                                                                   name="caption-font"
                                                                                                   id="caption-font-40"
                                                                                                   value="Noticia Text">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-41"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Old
                                                                        Standard TT (serif)</label><input type="radio"
                                                                                                          name="caption-font"
                                                                                                          id="caption-font-41"
                                                                                                          value="Old Standard TT">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-42"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Lobster
                                                                        (display)</label><input type="radio"
                                                                                                name="caption-font"
                                                                                                id="caption-font-42"
                                                                                                value="Lobster"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-43"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Poiret
                                                                        One (display)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-43"
                                                                                                    value="Poiret One">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-44"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Abril
                                                                        Fatface (display)</label><input type="radio"
                                                                                                        name="caption-font"
                                                                                                        id="caption-font-44"
                                                                                                        value="Abril Fatface">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-45"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Sigmar
                                                                        One (display)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-45"
                                                                                                    value="Sigmar One">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-46"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Chewy
                                                                        (display)</label><input type="radio"
                                                                                                name="caption-font"
                                                                                                id="caption-font-46"
                                                                                                value="Chewy"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-47"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Patua
                                                                        One (display)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-47"
                                                                                                    value="Patua One">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-48"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Bangers
                                                                        (display)</label><input type="radio"
                                                                                                name="caption-font"
                                                                                                id="caption-font-48"
                                                                                                value="Bangers"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-49"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Lobster
                                                                        Two (display)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-49"
                                                                                                    value="Lobster Two">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-50"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Playball
                                                                        (display)</label><input type="radio"
                                                                                                name="caption-font"
                                                                                                id="caption-font-50"
                                                                                                value="Playball"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-51"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Passion
                                                                        One (display)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-51"
                                                                                                    value="Passion One">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-52"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Righteous
                                                                        (display)</label><input type="radio"
                                                                                                name="caption-font"
                                                                                                id="caption-font-52"
                                                                                                value="Righteous"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-53"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Bevan
                                                                        (display)</label><input type="radio"
                                                                                                name="caption-font"
                                                                                                id="caption-font-53"
                                                                                                value="Bevan"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-54"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Special
                                                                        Elite (display)</label><input type="radio"
                                                                                                      name="caption-font"
                                                                                                      id="caption-font-54"
                                                                                                      value="Special Elite">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-55"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Alfa
                                                                        Slab One (display)</label><input type="radio"
                                                                                                         name="caption-font"
                                                                                                         id="caption-font-55"
                                                                                                         value="Alfa Slab One">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-56"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Comfortaa
                                                                        (display)</label><input type="radio"
                                                                                                name="caption-font"
                                                                                                id="caption-font-56"
                                                                                                value="Comfortaa"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-57"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Changa
                                                                        One (display)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-57"
                                                                                                    value="Changa One">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-58"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Luckiest
                                                                        Guy (display)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-58"
                                                                                                    value="Luckiest Guy">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-59"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Fugaz
                                                                        One (display)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-59"
                                                                                                    value="Fugaz One">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-60"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Fredoka
                                                                        One (display)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-60"
                                                                                                    value="Fredoka One">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-61"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Squada
                                                                        One (display)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-61"
                                                                                                    value="Squada One">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-62"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Indie
                                                                        Flower (handwriting)</label><input type="radio"
                                                                                                           name="caption-font"
                                                                                                           id="caption-font-62"
                                                                                                           value="Indie Flower">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-63"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Shadows
                                                                        Into Light (handwriting)</label><input
                                                                            type="radio" name="caption-font"
                                                                            id="caption-font-63"
                                                                            value="Shadows Into Light"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-64"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Pacifico
                                                                        (handwriting)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-64"
                                                                                                    value="Pacifico">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-65"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Dancing
                                                                        Script (handwriting)</label><input type="radio"
                                                                                                           name="caption-font"
                                                                                                           id="caption-font-65"
                                                                                                           value="Dancing Script">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-66"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Gloria
                                                                        Hallelujah (handwriting)</label><input
                                                                            type="radio" name="caption-font"
                                                                            id="caption-font-66"
                                                                            value="Gloria Hallelujah"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-67"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Amatic
                                                                        SC (handwriting)</label><input type="radio"
                                                                                                       name="caption-font"
                                                                                                       id="caption-font-67"
                                                                                                       value="Amatic SC">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-68"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Architects
                                                                        Daughter (handwriting)</label><input
                                                                            type="radio" name="caption-font"
                                                                            id="caption-font-68"
                                                                            value="Architects Daughter"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-69"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Kaushan
                                                                        Script (handwriting)</label><input type="radio"
                                                                                                           name="caption-font"
                                                                                                           id="caption-font-69"
                                                                                                           value="Kaushan Script">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-70"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Coming
                                                                        Soon (handwriting)</label><input type="radio"
                                                                                                         name="caption-font"
                                                                                                         id="caption-font-70"
                                                                                                         value="Coming Soon">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-71"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Covered
                                                                        By Your Grace (handwriting)</label><input
                                                                            type="radio" name="caption-font"
                                                                            id="caption-font-71"
                                                                            value="Covered By Your Grace"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-72"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Courgette
                                                                        (handwriting)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-72"
                                                                                                    value="Courgette">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-73"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Rock
                                                                        Salt (handwriting)</label><input type="radio"
                                                                                                         name="caption-font"
                                                                                                         id="caption-font-73"
                                                                                                         value="Rock Salt">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-74"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Shadows
                                                                        Into Light Two (handwriting)</label><input
                                                                            type="radio" name="caption-font"
                                                                            id="caption-font-74"
                                                                            value="Shadows Into Light Two"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-75"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Satisfy
                                                                        (handwriting)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-75"
                                                                                                    value="Satisfy">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-76"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Pinyon
                                                                        Script (handwriting)</label><input type="radio"
                                                                                                           name="caption-font"
                                                                                                           id="caption-font-76"
                                                                                                           value="Pinyon Script">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-77"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Permanent
                                                                        Marker (handwriting)</label><input type="radio"
                                                                                                           name="caption-font"
                                                                                                           id="caption-font-77"
                                                                                                           value="Permanent Marker">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-78"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Handlee
                                                                        (handwriting)</label><input type="radio"
                                                                                                    name="caption-font"
                                                                                                    id="caption-font-78"
                                                                                                    value="Handlee">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-79"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Crafty
                                                                        Girls (handwriting)</label><input type="radio"
                                                                                                          name="caption-font"
                                                                                                          id="caption-font-79"
                                                                                                          value="Crafty Girls">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-80"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Marck
                                                                        Script (handwriting)</label><input type="radio"
                                                                                                           name="caption-font"
                                                                                                           id="caption-font-80"
                                                                                                           value="Marck Script">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-81"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Great
                                                                        Vibes (handwriting)</label><input type="radio"
                                                                                                          name="caption-font"
                                                                                                          id="caption-font-81"
                                                                                                          value="Great Vibes">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-82"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">monospace
                                                                        (monospace)</label><input type="radio"
                                                                                                  name="caption-font"
                                                                                                  id="caption-font-82"
                                                                                                  value="monospace">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-83"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Inconsolata
                                                                        (monospace)</label><input type="radio"
                                                                                                  name="caption-font"
                                                                                                  id="caption-font-83"
                                                                                                  value="Inconsolata">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-84"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Source
                                                                        Code Pro (monospace)</label><input type="radio"
                                                                                                           name="caption-font"
                                                                                                           id="caption-font-84"
                                                                                                           value="Source Code Pro">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-85"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Droid
                                                                        Sans Mono (monospace)</label><input type="radio"
                                                                                                            name="caption-font"
                                                                                                            id="caption-font-85"
                                                                                                            value="Droid Sans Mono">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-86"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Ubuntu
                                                                        Mono (monospace)</label><input type="radio"
                                                                                                       name="caption-font"
                                                                                                       id="caption-font-86"
                                                                                                       value="Ubuntu Mono">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-87"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">VT323
                                                                        (monospace)</label><input type="radio"
                                                                                                  name="caption-font"
                                                                                                  id="caption-font-87"
                                                                                                  value="VT323"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-88"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Cousine
                                                                        (monospace)</label><input type="radio"
                                                                                                  name="caption-font"
                                                                                                  id="caption-font-88"
                                                                                                  value="Cousine"></div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-89"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">PT
                                                                        Mono (monospace)</label><input type="radio"
                                                                                                       name="caption-font"
                                                                                                       id="caption-font-89"
                                                                                                       value="PT Mono">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-90"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Anonymous
                                                                        Pro (monospace)</label><input type="radio"
                                                                                                      name="caption-font"
                                                                                                      id="caption-font-90"
                                                                                                      value="Anonymous Pro">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-91"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">Nova
                                                                        Mono (monospace)</label><input type="radio"
                                                                                                       name="caption-font"
                                                                                                       id="caption-font-91"
                                                                                                       value="Nova Mono">
                                                                </div>


                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-font-92"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off ui-last-child">Fira
                                                                        Mono (monospace)</label><input type="radio"
                                                                                                       name="caption-font"
                                                                                                       id="caption-font-92"
                                                                                                       value="Fira Mono">
                                                                </div>


                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>

                                                <!-- Caption Positioning-->
                                                <div class="control-field-caption-positioning">
                                                    <div class="col col-1-5">
                                                        <div class="control-field control-field-disableable">
                                                            <fieldset data-role="controlgroup" data-type="vertical"
                                                                      data-mini="true"
                                                                      class="ui-controlgroup ui-controlgroup-vertical ui-corner-all ui-mini">
                                                                <div role="heading" class="ui-controlgroup-label">
                                                                    <legend>Shape</legend>
                                                                </div>
                                                                <div class="ui-controlgroup-controls ">

                                                                    <div class="ui-radio ui-mini"><label
                                                                                for="caption-shape-square"
                                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off ui-first-child"><span
                                                                                    class="icon icon-16 icon-caption-shape-square"
                                                                                    title="square corners">&nbsp;</span></label><input
                                                                                type="radio" name="caption-shape"
                                                                                id="caption-shape-square"
                                                                                value="square"></div>

                                                                    <div class="ui-radio ui-mini"><label
                                                                                for="caption-shape-rounded"
                                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on"><span
                                                                                    class="icon icon-16 icon-caption-shape-rounded"
                                                                                    title="rounded corners">&nbsp;</span></label><input
                                                                                type="radio" name="caption-shape"
                                                                                id="caption-shape-rounded"
                                                                                value="rounded" checked="checked"></div>

                                                                    <div class="ui-radio ui-mini"><label
                                                                                for="caption-shape-superround"
                                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off ui-last-child"><span
                                                                                    class="icon icon-16 icon-caption-shape-super-round"
                                                                                    title="super round corners">&nbsp;</span></label><input
                                                                                type="radio" name="caption-shape"
                                                                                id="caption-shape-superround"
                                                                                value="superround"></div>

                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    <div class="col col-3-5 col-pad-both">
                                                        <div class="control-field control-field-disableable">
                                                            <div class="caption-positioner">
                                                                <div class="caption-box" style="top: 10%; left: 5%;">
                                                                    abc
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="control-field control-field-disableable control-field-slider control-field-caption-pos-h">
                                                            <div class="ui-slider"><input type="number"
                                                                                          data-type="range"
                                                                                          name="caption-pos-h"
                                                                                          id="caption-pos-h" value="5"
                                                                                          min="0" max="90" step="1"
                                                                                          class="ui-shadow-inset ui-body-inherit ui-corner-all ui-slider-input">
                                                                <div role="application"
                                                                     class="ui-slider-track ui-shadow-inset ui-bar-inherit ui-corner-all"
                                                                     aria-disabled="false"><a href="#"
                                                                                              class="ui-slider-handle ui-btn ui-shadow"
                                                                                              role="slider"
                                                                                              aria-valuemin="0"
                                                                                              aria-valuemax="90"
                                                                                              aria-valuenow="5"
                                                                                              aria-valuetext="5"
                                                                                              title="5"
                                                                                              aria-labelledby="caption-pos-h-label"
                                                                                              style="left: 5.55556%;"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="control-field control-field-disableable control-field-slider control-field-caption-pos-v">
                                                            <div class="ui-slider"><input type="number"
                                                                                          data-type="range"
                                                                                          name="caption-pos-v"
                                                                                          id="caption-pos-v" value="10"
                                                                                          min="0" max="90" step="1"
                                                                                          class="ui-shadow-inset ui-body-inherit ui-corner-all ui-slider-input">
                                                                <div role="application"
                                                                     class="ui-slider-track ui-shadow-inset ui-bar-inherit ui-corner-all"
                                                                     aria-disabled="false"><a href="#"
                                                                                              class="ui-slider-handle ui-btn ui-shadow"
                                                                                              role="slider"
                                                                                              aria-valuemin="0"
                                                                                              aria-valuemax="90"
                                                                                              aria-valuenow="10"
                                                                                              aria-valuetext="10"
                                                                                              title="10"
                                                                                              aria-labelledby="caption-pos-v-label"
                                                                                              style="left: 11.1111%;"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-1-5">
                                                        <div class="control-field control-field-disableable">
                                                            <fieldset data-role="controlgroup" data-type="vertical"
                                                                      data-mini="true"
                                                                      class="ui-controlgroup ui-controlgroup-vertical ui-corner-all ui-mini">
                                                                <div role="heading" class="ui-controlgroup-label">
                                                                    <legend>Border</legend>
                                                                </div>
                                                                <div class="ui-controlgroup-controls ">

                                                                    <div class="ui-radio ui-mini"><label
                                                                                for="caption-border-none"
                                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"><span
                                                                                    class="icon icon-16 icon-border-none"
                                                                                    title="no border">&nbsp;</span></label><input
                                                                                type="radio" name="caption-border"
                                                                                id="caption-border-none" value="none"
                                                                                checked="checked"></div>

                                                                    <div class="ui-radio ui-mini"><label
                                                                                for="caption-border-thin"
                                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off"><span
                                                                                    class="icon icon-16 icon-border-thin"
                                                                                    title="thin border">&nbsp;</span></label><input
                                                                                type="radio" name="caption-border"
                                                                                id="caption-border-thin" value="thin">
                                                                    </div>

                                                                    <div class="ui-radio ui-mini"><label
                                                                                for="caption-border-thick"
                                                                                class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off ui-last-child"><span
                                                                                    class="icon icon-16 icon-border-thick"
                                                                                    title="thick border">&nbsp;</span></label><input
                                                                                type="radio" name="caption-border"
                                                                                id="caption-border-thick" value="thick">
                                                                    </div>

                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="col col-1-2">
                                                    <div class="control-field control-field-disableable">
                                                        <fieldset data-role="controlgroup" data-type="horizontal"
                                                                  data-mini="true"
                                                                  class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                            <div role="heading" class="ui-controlgroup-label">
                                                                <legend>Color</legend>
                                                            </div>
                                                            <div class="ui-controlgroup-controls ">

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-color-white-on-black"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-first-child"><span
                                                                                class="icon icon-16 icon-color-white-on-black"
                                                                                title="white text on black background">&nbsp;</span></label><input
                                                                            type="radio" name="caption-color"
                                                                            id="caption-color-white-on-black"
                                                                            value="white-on-black" checked="checked">
                                                                </div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-color-black-on-white"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                                class="icon icon-16 icon-color-black-on-white"
                                                                                title="black text on white background">&nbsp;</span></label><input
                                                                            type="radio" name="caption-color"
                                                                            id="caption-color-black-on-white"
                                                                            value="black-on-white"></div>

                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="col col-1-2">
                                                    <div class="control-field control-field-disableable">
                                                        <fieldset data-role="controlgroup" data-type="horizontal"
                                                                  data-mini="true"
                                                                  class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                            <div role="heading" class="ui-controlgroup-label">
                                                                <legend>Trans</legend>
                                                            </div>
                                                            <div class="ui-controlgroup-controls ">

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-trans-40"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-first-child"><span
                                                                                class="icon icon-16 icon-opacity-40"
                                                                                title="40% opacity">&nbsp;</span></label><input
                                                                            type="radio" name="caption-trans"
                                                                            id="caption-trans-40" value="40"></div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-trans-70"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active"><span
                                                                                class="icon icon-16 icon-opacity-70"
                                                                                title="70% opacity">&nbsp;</span></label><input
                                                                            type="radio" name="caption-trans"
                                                                            id="caption-trans-70" value="70"
                                                                            checked="checked"></div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-trans-100"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                                class="icon icon-16 icon-opacity-100"
                                                                                title="100% opacity">&nbsp;</span></label><input
                                                                            type="radio" name="caption-trans"
                                                                            id="caption-trans-100" value="100"></div>

                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                                <div class="col col-2-3">
                                                    <div class="control-field control-field-disableable">
                                                        <fieldset data-role="controlgroup" data-type="horizontal"
                                                                  data-mini="true"
                                                                  class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                            <div role="heading" class="ui-controlgroup-label">
                                                                <legend>Caption Link Target</legend>
                                                            </div>
                                                            <div class="ui-controlgroup-controls ">

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-link-target-none"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-first-child"><span
                                                                                class="icon icon-16 icon-link-none"
                                                                                title="no link">&nbsp;</span></label><input
                                                                            type="radio" name="caption-link-target"
                                                                            id="caption-link-target-none" value="none"
                                                                            checked="checked"></div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-link-target-_self"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                                class="icon icon-16 icon-link"
                                                                                title="link">&nbsp;</span></label><input
                                                                            type="radio" name="caption-link-target"
                                                                            id="caption-link-target-_self"
                                                                            value="_self"></div>

                                                                <div class="ui-radio ui-mini"><label
                                                                            for="caption-link-target-_blank"
                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                                class="icon icon-16 icon-link-new-tab"
                                                                                title="link - new tab">&nbsp;</span></label><input
                                                                            type="radio" name="caption-link-target"
                                                                            id="caption-link-target-_blank"
                                                                            value="_blank"></div>

                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="col col-1-3 help-tools help-tools-row">
                                                    <a class="help ui-link" href="#doc-captions"
                                                       title="Learn about captions" data-ajax="false">?</a>
                                                </div>
                                                <div class="clear"></div>
                                                <div class="control-field control-field-disableable">
                                                    <div class="ui-input-text ui-shadow-inset mobile-textinput-disabled ui-body-inherit ui-corner-all ui-state-disabled">
                                                        <input type="text" name="caption-link-href"
                                                               id="caption-link-href" placeholder="http://"
                                                               data-disabled="true" disabled=""></div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- end of CAPTIONS -->

                                    </div>
                                    <!-- end of .controls-group-slides -->

                                    <div class="controls-group controls-group-id">
                                        <div class="col col-1-2">
                                            <div class="control-field">
                                                <label for="element-id">Slider element ID</label>
                                            </div>
                                        </div>
                                        <div class="col col-1-3">
                                            <div class="control-field">
                                                <div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset">
                                                    <input type="text" name="element-id" id="element-id"
                                                           placeholder="Slider element ID" size="20" value="my-slider">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-1-6">
                                            <div class="help-tools">
                                                <a class="help ui-link" href="#doc-element-id"
                                                   title="Learn about setting your sliders' element IDs"
                                                   data-ajax="false">?</a>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <!--
                                    <p>
                                      <fb:like data-layout="button" style="vertical-align:top;"></fb:like>
                                      <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-count="none" style="vertical-align:top;">Tweet</a>
                                      <g:plusone size="medium" annotation="none"></g:plusone>
                                    </p>
                                    -->

                                </div>
                                <!-- end of col 1 -->

                                <div class="col col-1-3 col-2">
                                    <div class="controls-group controls-group-dimensions ui-collapsible ui-collapsible-inset ui-corner-all ui-collapsible-themed-content"
                                         data-role="collapsible" data-collapsed="false" data-collapsed-icon="carat-d"
                                         data-expanded-icon="carat-u"><h4 class="ui-collapsible-heading"><a href="#"
                                                                                                            class="ui-collapsible-heading-toggle ui-btn ui-icon-carat-u ui-btn-icon-left ui-btn-inherit">Dimensions
                                                <span class="icon icon-32x16 icon-dimensions"
                                                      title="Dimensions">&nbsp;</span> <a class="help ui-link"
                                                                                          href="#doc-dimensions"
                                                                                          title="Learn how to change width, height and corner rounding"
                                                                                          data-ajax="false">?</a><span
                                                        class="ui-collapsible-heading-status"> click to collapse contents</span></a>
                                        </h4>
                                        <div class="ui-collapsible-content ui-body-inherit" aria-hidden="false">

                                            <div class="col col-1-3">
                                                <div class="control-field">
                                                    <div class="ui-checkbox ui-mini"><label for="responsive"
                                                                                            class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-checkbox-on"><span
                                                                    class="icon icon-32x16 icon-responsive"
                                                                    title="responsive">&nbsp;</span></label><input
                                                                type="checkbox" name="responsive" id="responsive"
                                                                checked="checked" data-mini="true"></div>

                                                </div>
                                            </div>
                                            <div class="col col-2-3">
                                                <div class="control-field control-field-slider control-field-slider-width">
                                                    <div class="ui-slider slider-disabled"><input type="number"
                                                                                                  data-type="range"
                                                                                                  name="width"
                                                                                                  id="width" value="900"
                                                                                                  min="400" max="1600"
                                                                                                  step="1"
                                                                                                  class="ui-shadow-inset ui-body-inherit ui-corner-all ui-slider-input">
                                                        <div role="application"
                                                             class="ui-slider-track ui-shadow-inset ui-bar-inherit ui-corner-all">
                                                            <a href="#" class="ui-slider-handle ui-btn ui-shadow"
                                                               role="slider" aria-valuemin="400" aria-valuemax="1600"
                                                               aria-valuenow="900" aria-valuetext="900" title="900"
                                                               aria-labelledby="width-label"
                                                               style="left: 41.6667%;"></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="col col-1-3">
                                                <div class="control-field">
                                                    <fieldset data-role="controlgroup" data-type="horizontal"
                                                              data-mini="true"
                                                              class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                        <div role="heading" class="ui-controlgroup-label">
                                                            <legend>Height Type</legend>
                                                        </div>
                                                        <div class="ui-controlgroup-controls ">

                                                            <div class="ui-radio ui-mini"><label for="height-type-px"
                                                                                                 class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-first-child">px</label><input
                                                                        type="radio" name="height-type"
                                                                        id="height-type-px" value="px"></div>

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="height-type-percent"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-last-child">%</label><input
                                                                        type="radio" name="height-type"
                                                                        id="height-type-percent" value="percent"
                                                                        checked="checked"></div>

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="col col-2-3">
                                                <div class="control-field control-field-slider control-field-slider-height control-field-slider-height-px">
                                                    <div class="ui-slider" style="display: none;"><input type="number"
                                                                                                         data-type="range"
                                                                                                         name="height-px"
                                                                                                         id="height-px"
                                                                                                         value="200"
                                                                                                         min="100"
                                                                                                         max="600"
                                                                                                         step="1"
                                                                                                         class="ui-shadow-inset ui-body-inherit ui-corner-all ui-slider-input">
                                                        <div role="application"
                                                             class="ui-slider-track ui-shadow-inset ui-bar-inherit ui-corner-all">
                                                            <a href="#" class="ui-slider-handle ui-btn ui-shadow"
                                                               role="slider" aria-valuemin="100" aria-valuemax="600"
                                                               aria-valuenow="200" aria-valuetext="200" title="200"
                                                               aria-labelledby="height-px-label" style="left: 20%;"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-field control-field-slider control-field-slider-height control-field-slider-height-percent">
                                                    <div class="ui-slider"><input type="number" data-type="range"
                                                                                  name="height-percent"
                                                                                  id="height-percent" value="25"
                                                                                  min="15" max="75" step="1"
                                                                                  class="ui-shadow-inset ui-body-inherit ui-corner-all ui-slider-input">
                                                        <div role="application"
                                                             class="ui-slider-track ui-shadow-inset ui-bar-inherit ui-corner-all">
                                                            <a href="#" class="ui-slider-handle ui-btn ui-shadow"
                                                               role="slider" aria-valuemin="15" aria-valuemax="75"
                                                               aria-valuenow="25" aria-valuetext="25" title="25"
                                                               aria-labelledby="height-percent-label"
                                                               style="left: 16.6667%;"></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="control-field">
                                                <fieldset data-role="controlgroup" data-type="horizontal"
                                                          data-mini="true"
                                                          class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                    <div role="heading" class="ui-controlgroup-label">
                                                        <legend>Corners</legend>
                                                    </div>
                                                    <div class="ui-controlgroup-controls ">

                                                        <div class="ui-radio ui-mini"><label for="corners-square"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-first-child"><span
                                                                        class="icon icon-32x16 icon-rectangle-large"
                                                                        title="square corners">&nbsp;</span></label><input
                                                                    type="radio" name="corners" id="corners-square"
                                                                    value="square"></div>

                                                        <div class="ui-radio ui-mini"><label for="corners-round"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active"><span
                                                                        class="icon icon-32x16 icon-rectangle-rounded-large"
                                                                        title="rounded corners">&nbsp;</span></label><input
                                                                    type="radio" name="corners" id="corners-round"
                                                                    value="round" checked="checked"></div>

                                                        <div class="ui-radio ui-mini"><label for="corners-superround"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                        class="icon icon-32x16 icon-rectangle-super-round-large"
                                                                        title="super round corners">&nbsp;</span></label><input
                                                                    type="radio" name="corners" id="corners-superround"
                                                                    value="superround"></div>

                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="controls-group controls-group-transitions ui-collapsible ui-collapsible-inset ui-corner-all ui-collapsible-themed-content"
                                         data-role="collapsible" data-collapsed="false" data-collapsed-icon="carat-d"
                                         data-expanded-icon="carat-u"><h4 class="ui-collapsible-heading"><a href="#"
                                                                                                            class="ui-collapsible-heading-toggle ui-btn ui-icon-carat-u ui-btn-icon-left ui-btn-inherit">Transitions
                                                <span class="icon icon-32x16 icon-transitions" title="Transitions">&nbsp;</span>
                                                <a class="help ui-link" href="#doc-transitions"
                                                   title="Learn about transitions" data-ajax="false">?</a><span
                                                        class="ui-collapsible-heading-status"> click to collapse contents</span></a>
                                        </h4>
                                        <div class="ui-collapsible-content ui-body-inherit" aria-hidden="false">

                                            <div class="control-field">
                                                <fieldset data-role="controlgroup" data-type="horizontal"
                                                          data-mini="true"
                                                          class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                    <div role="heading" class="ui-controlgroup-label">
                                                        <legend>Transition Type</legend>
                                                    </div>
                                                    <div class="ui-controlgroup-controls ">

                                                        <div class="ui-radio ui-mini"><label
                                                                    for="transition-type-instant"
                                                                    class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-first-child"><span
                                                                        class="icon icon-16 icon-none" title="instant">&nbsp;</span></label><input
                                                                    type="radio" name="transition-type"
                                                                    id="transition-type-instant" value="instant"></div>

                                                        <div class="ui-radio ui-mini"><label for="transition-type-slide"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active"><span
                                                                        class="icon icon-32x16 icon-transition-type-slide"
                                                                        title="slide">&nbsp;</span></label><input
                                                                    type="radio" name="transition-type"
                                                                    id="transition-type-slide" value="slide"
                                                                    checked="checked"></div>

                                                        <div class="ui-radio ui-mini"><label for="transition-type-fade"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                        class="icon icon-32x16 icon-transition-type-fade"
                                                                        title="fade">&nbsp;</span></label><input
                                                                    type="radio" name="transition-type"
                                                                    id="transition-type-fade" value="fade"></div>

                                                        <div class="ui-radio ui-mini"><label for="transition-type-zoom"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                        class="icon icon-32x16 icon-transition-type-zoom"
                                                                        title="zoom">&nbsp;</span></label><input
                                                                    type="radio" name="transition-type"
                                                                    id="transition-type-zoom" value="zoom"></div>

                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="control-field">
                                                <fieldset data-role="controlgroup" data-type="horizontal"
                                                          data-mini="true"
                                                          class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                    <div role="heading" class="ui-controlgroup-label">
                                                        <legend>Auto Play</legend>
                                                    </div>
                                                    <div class="ui-controlgroup-controls ">

                                                        <div class="ui-radio ui-mini"><label for="play-type-manual"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-first-child"><span
                                                                        class="icon icon-16 icon-play-manual"
                                                                        title="manual">&nbsp;</span></label><input
                                                                    type="radio" name="play-type" id="play-type-manual"
                                                                    value="manual" checked="checked"></div>

                                                        <div class="ui-radio ui-mini"><label for="play-type-once"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                        class="icon icon-16 icon-play-once"
                                                                        title="play once">&nbsp;</span></label><input
                                                                    type="radio" name="play-type" id="play-type-once"
                                                                    value="once"></div>

                                                        <div class="ui-radio ui-mini"><label for="play-type-once-rewind"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                        class="icon icon-16 icon-play-once-rewind"
                                                                        title="play once and rewind">&nbsp;</span></label><input
                                                                    type="radio" name="play-type"
                                                                    id="play-type-once-rewind" value="once-rewind">
                                                        </div>

                                                        <div class="ui-radio ui-mini"><label for="play-type-loop"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                        class="icon icon-16 icon-play-loop"
                                                                        title="loop">&nbsp;</span></label><input
                                                                    type="radio" name="play-type" id="play-type-loop"
                                                                    value="loop"></div>

                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col col-1-2">
                                                <div class="control-field control-field-disableable">
                                                    <fieldset data-role="controlgroup" data-type="horizontal"
                                                              data-mini="true"
                                                              class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                        <div role="heading" class="ui-controlgroup-label">
                                                            <legend>Play Speed</legend>
                                                        </div>
                                                        <div class="ui-controlgroup-controls ">

                                                            <div class="ui-radio ui-mini ui-state-disabled"><label
                                                                        for="speed-slow"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-first-child"><span
                                                                            class="icon icon-16 icon-speed-slow"
                                                                            title="slow">&nbsp;</span></label><input
                                                                        type="radio" name="speed" id="speed-slow"
                                                                        value="slow" disabled=""></div>

                                                            <div class="ui-radio ui-mini ui-state-disabled"><label
                                                                        for="speed-medium"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active"><span
                                                                            class="icon icon-16 icon-speed-medium"
                                                                            title="medium">&nbsp;</span></label><input
                                                                        type="radio" name="speed" id="speed-medium"
                                                                        value="medium" checked="checked" disabled="">
                                                            </div>

                                                            <div class="ui-radio ui-mini ui-state-disabled"><label
                                                                        for="speed-fast"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                            class="icon icon-16 icon-speed-fast"
                                                                            title="fast">&nbsp;</span></label><input
                                                                        type="radio" name="speed" id="speed-fast"
                                                                        value="fast" disabled=""></div>

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="col col-1-2">
                                                <div class="control-field">
                                                    <fieldset data-role="controlgroup" data-type="horizontal"
                                                              data-mini="true"
                                                              class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                        <div role="heading" class="ui-controlgroup-label">
                                                            <legend>Image Effect</legend>
                                                        </div>
                                                        <div class="ui-controlgroup-controls ">

                                                            <div class="ui-radio ui-mini"><label for="image-fx-none"
                                                                                                 class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-first-child"><span
                                                                            class="icon icon-16 icon-none"
                                                                            title="no effect">&nbsp;</span></label><input
                                                                        type="radio" name="image-fx" id="image-fx-none"
                                                                        value="none" checked="checked"></div>

                                                            <div class="ui-radio ui-mini"><label for="image-fx-zoompan"
                                                                                                 class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                            class="icon icon-16 icon-fx-zoompan"
                                                                            title="zoom-pan">&nbsp;</span></label><input
                                                                        type="radio" name="image-fx"
                                                                        id="image-fx-zoompan" value="zoompan"></div>

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="image-fx-zoomrotate"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                            class="icon icon-16 icon-fx-zoomrotate"
                                                                            title="zoom-rotate">&nbsp;</span></label><input
                                                                        type="radio" name="image-fx"
                                                                        id="image-fx-zoomrotate" value="zoomrotate">
                                                            </div>

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <!--
                                            <div class="control-field control-field-disableable">
                                              <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                                                <legend>Pause</legend>
                                                <input type="radio" name="pause" id="pause-never" value="never">
                                                <label for="pause-never"><span class="icon icon-16 icon-pause-never" title="never pause">&nbsp;</span></label>
                                                <input type="radio" name="pause" id="pause-hover" value="hover" checked="checked">
                                                <label for="pause-hover"><span class="icon icon-16 icon-pause-hover" title="pause on hover">&nbsp;</span></label>
                                                <input type="radio" name="pause" id="pause-touch" value="touch">
                                                <label for="pause-touch"><span class="icon icon-16 icon-pause-touch" title="pause on touch">&nbsp;</span></label>
                                              </fieldset>
                                            </div>
                                            -->
                                        </div>
                                    </div>


                                    <div class="ad-v2-top">

                                        <!-- v2 top center -->
                                        <script async=""
                                                src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                        <ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px"
                                             data-ad-client="ca-pub-4226366447966984" data-ad-slot="7284651177"></ins>
                                        <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                        </script>

                                        <!--
                                        <a href="//shutterstock.7eer.net/c/166542/276895/1305"><img src="//a.impactradius-go.com/display-ad/1305-276895" border="0" alt="Get Started Now With Shutterstock" width="300" height="250"/></a><img height="0" width="0" src="//shutterstock.7eer.net/i/166542/276895/1305" style="position:absolute;visibility:hidden;" border="0" />
                                        -->

                                    </div>


                                    <!--
                                    <div style="text-align: center;">
                                      <a href="http://ninetyninedesigns.7eer.net/c/167438/177081/3172">
                                        <img src="http://adn.impactradius.com/display-ad/3172-177081" border="0" alt="" width="300" height="250"/>
                                      </a>
                                      <img height="0" width="0" src="http://ninetyninedesigns.7eer.net/i/167438/177081/3172" style="position:absolute;visibility:hidden;" border="0" />
                                    </div>
                                    -->

                                </div>
                                <!-- end of col 2 -->

                                <div class="col col-1-3 col-3">
                                    <div class="controls-group controls-group-buttons ui-collapsible ui-collapsible-inset ui-corner-all ui-collapsible-themed-content"
                                         data-role="collapsible" data-collapsed="false" data-collapsed-icon="carat-d"
                                         data-expanded-icon="carat-u"><h4 class="ui-collapsible-heading"><a href="#"
                                                                                                            class="ui-collapsible-heading-toggle ui-btn ui-icon-carat-u ui-btn-icon-left ui-btn-inherit">Back
                                                / Fwd Buttons <span class="icon icon-32x16 icon-buttons"
                                                                    title="Buttons">&nbsp;</span> <a
                                                        class="help ui-link" href="#doc-buttons"
                                                        title="Learn about back / forward buttons"
                                                        data-ajax="false">?</a><span
                                                        class="ui-collapsible-heading-status"> click to collapse contents</span></a>
                                        </h4>
                                        <div class="ui-collapsible-content ui-body-inherit" aria-hidden="false">

                                            <div class="col col-1-3">
                                                <div class="control-field">
                                                    <div class="ui-flipswitch ui-shadow-inset ui-bar-inherit ui-flipswitch-active ui-corner-all ui-mini">
                                                        <a href="#"
                                                           class="ui-flipswitch-on ui-btn ui-shadow ui-btn-inherit">On</a><span
                                                                class="ui-flipswitch-off">Off</span><input
                                                                type="checkbox" data-role="flipswitch"
                                                                name="button-enable" id="button-enable"
                                                                checked="checked" data-mini="true"
                                                                class="ui-flipswitch-input" tabindex="-1"></div>
                                                </div>
                                            </div>
                                            <div class="col col-2-3">
                                                <div class="control-field control-field-disableable">
                                                    <fieldset data-role="controlgroup" data-type="horizontal"
                                                              data-mini="true"
                                                              class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                        <div role="heading" class="ui-controlgroup-label">
                                                            <legend>Visibility</legend>
                                                        </div>
                                                        <div class="ui-controlgroup-controls ">

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="button-visibility-invisible"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-first-child"><span
                                                                            class="icon icon-16 icon-invisible"
                                                                            title="invisible">&nbsp;</span></label><input
                                                                        type="radio" name="button-visibility"
                                                                        id="button-visibility-invisible"
                                                                        value="invisible"></div>

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="button-visibility-autohide"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                            class="icon icon-16 icon-auto-visible"
                                                                            title="auto hide">&nbsp;</span></label><input
                                                                        type="radio" name="button-visibility"
                                                                        id="button-visibility-autohide"
                                                                        value="autohide"></div>

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="button-visibility-visible"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-last-child"><span
                                                                            class="icon icon-16 icon-visible"
                                                                            title="visible">&nbsp;</span></label><input
                                                                        type="radio" name="button-visibility"
                                                                        id="button-visibility-visible" value="visible"
                                                                        checked="checked"></div>

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="col col-1-2">
                                                <div class="control-field control-field-disableable">
                                                    <fieldset data-role="controlgroup" data-type="horizontal"
                                                              data-mini="true"
                                                              class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                        <div role="heading" class="ui-controlgroup-label">
                                                            <legend>Icon</legend>
                                                        </div>
                                                        <div class="ui-controlgroup-controls ">

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="button-icon-chevron"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-first-child"><span
                                                                            class="icon icon-16 icon-chevron"
                                                                            title="chevron">&nbsp;</span></label><input
                                                                        type="radio" name="button-icon"
                                                                        id="button-icon-chevron" value="chevron"
                                                                        checked="checked"></div>

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="button-icon-triangle"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                            class="icon icon-16 icon-triangle"
                                                                            title="triangle">&nbsp;</span></label><input
                                                                        type="radio" name="button-icon"
                                                                        id="button-icon-triangle" value="triangle">
                                                            </div>

                                                            <div class="ui-radio ui-mini"><label for="button-icon-arrow"
                                                                                                 class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                            class="icon icon-16 icon-arrow"
                                                                            title="arrow">&nbsp;</span></label><input
                                                                        type="radio" name="button-icon"
                                                                        id="button-icon-arrow" value="arrow"></div>

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="col col-1-2">
                                                <div class="control-field control-field-disableable">
                                                    <fieldset data-role="controlgroup" data-type="horizontal"
                                                              data-mini="true"
                                                              class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                        <div role="heading" class="ui-controlgroup-label">
                                                            <legend>Size</legend>
                                                        </div>
                                                        <div class="ui-controlgroup-controls ">

                                                            <div class="ui-radio ui-mini"><label for="button-size-small"
                                                                                                 class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-first-child"><span
                                                                            class="icon icon-8 icon-button-size-small"
                                                                            title="small">&nbsp;</span></label><input
                                                                        type="radio" name="button-size"
                                                                        id="button-size-small" value="small"></div>

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="button-size-medium"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active"><span
                                                                            class="icon icon-12 icon-button-size-medium"
                                                                            title="medium">&nbsp;</span></label><input
                                                                        type="radio" name="button-size"
                                                                        id="button-size-medium" value="medium"
                                                                        checked="checked"></div>

                                                            <div class="ui-radio ui-mini"><label for="button-size-large"
                                                                                                 class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                            class="icon icon-16 icon-button-size-large"
                                                                            title="large">&nbsp;</span></label><input
                                                                        type="radio" name="button-size"
                                                                        id="button-size-large" value="large"></div>

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="control-field control-field-disableable">
                                                <fieldset data-role="controlgroup" data-type="horizontal"
                                                          data-mini="true"
                                                          class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                    <div role="heading" class="ui-controlgroup-label">
                                                        <legend>Shape</legend>
                                                    </div>
                                                    <div class="ui-controlgroup-controls ">

                                                        <div class="ui-radio ui-mini"><label for="button-shape-none"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-first-child"><span
                                                                        class="icon icon-16 icon-none" title="none">&nbsp;</span></label><input
                                                                    type="radio" name="button-shape"
                                                                    id="button-shape-none" value="none"></div>

                                                        <div class="ui-radio ui-mini"><label for="button-shape-square"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                        class="icon icon-16 icon-square" title="square">&nbsp;</span></label><input
                                                                    type="radio" name="button-shape"
                                                                    id="button-shape-square" value="square"></div>

                                                        <div class="ui-radio ui-mini"><label for="button-shape-circle"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active"><span
                                                                        class="icon icon-16 icon-circle" title="circle">&nbsp;</span></label><input
                                                                    type="radio" name="button-shape"
                                                                    id="button-shape-circle" value="circle"
                                                                    checked="checked"></div>

                                                        <div class="ui-radio ui-mini"><label
                                                                    for="button-shape-semi-circle"
                                                                    class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                        class="icon icon-16 icon-semi-circle"
                                                                        title="semi-circle">&nbsp;</span></label><input
                                                                    type="radio" name="button-shape"
                                                                    id="button-shape-semi-circle" value="semi-circle">
                                                        </div>

                                                        <div class="ui-radio ui-mini"><label
                                                                    for="button-shape-full-height"
                                                                    class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                        class="icon icon-16 icon-rectangle-vertical"
                                                                        title="full height">&nbsp;</span></label><input
                                                                    type="radio" name="button-shape"
                                                                    id="button-shape-full-height" value="full-height">
                                                        </div>

                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="control-field control-field-disableable">
                                                <fieldset data-role="controlgroup" data-type="horizontal"
                                                          data-mini="true"
                                                          class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                    <div role="heading" class="ui-controlgroup-label">
                                                        <legend>Color</legend>
                                                    </div>
                                                    <div class="ui-controlgroup-controls ">

                                                        <div class="ui-radio ui-mini"><label
                                                                    for="button-color-white-on-black"
                                                                    class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-first-child"><span
                                                                        class="icon icon-16 icon-button-w-b"
                                                                        title="white on black">&nbsp;</span></label><input
                                                                    type="radio" name="button-color"
                                                                    id="button-color-white-on-black"
                                                                    value="white-on-black" checked="checked"></div>

                                                        <div class="ui-radio ui-mini"><label
                                                                    for="button-color-black-on-white"
                                                                    class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                        class="icon icon-16 icon-button-b-w"
                                                                        title="black on white">&nbsp;</span></label><input
                                                                    type="radio" name="button-color"
                                                                    id="button-color-black-on-white"
                                                                    value="black-on-white"></div>

                                                        <div class="ui-radio ui-mini"><label
                                                                    for="button-color-white-on-white"
                                                                    class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                        class="icon icon-16 icon-button-w-w"
                                                                        title="white on white">&nbsp;</span></label><input
                                                                    type="radio" name="button-color"
                                                                    id="button-color-white-on-white"
                                                                    value="white-on-white"></div>

                                                        <div class="ui-radio ui-mini"><label
                                                                    for="button-color-black-on-black"
                                                                    class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                        class="icon icon-16 icon-button-b-b"
                                                                        title="black on black">&nbsp;</span></label><input
                                                                    type="radio" name="button-color"
                                                                    id="button-color-black-on-black"
                                                                    value="black-on-black"></div>

                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="controls-group controls-group-radios ui-collapsible ui-collapsible-inset ui-corner-all ui-collapsible-themed-content"
                                         data-role="collapsible" data-collapsed="false" data-collapsed-icon="carat-d"
                                         data-expanded-icon="carat-u"><h4 class="ui-collapsible-heading"><a href="#"
                                                                                                            class="ui-collapsible-heading-toggle ui-btn ui-icon-carat-u ui-btn-icon-left ui-btn-inherit">Radio
                                                Buttons <span class="icon icon-32x16 icon-radios" title="Radio buttons">&nbsp;</span>
                                                <a class="help ui-link" href="#doc-radios"
                                                   title="Learn about radio buttons" data-ajax="false">?</a><span
                                                        class="ui-collapsible-heading-status"> click to collapse contents</span></a>
                                        </h4>
                                        <div class="ui-collapsible-content ui-body-inherit" aria-hidden="false">

                                            <div class="col col-1-3">
                                                <div class="control-field">
                                                    <div class="ui-flipswitch ui-shadow-inset ui-bar-inherit ui-flipswitch-active ui-corner-all ui-mini">
                                                        <a href="#"
                                                           class="ui-flipswitch-on ui-btn ui-shadow ui-btn-inherit">On</a><span
                                                                class="ui-flipswitch-off">Off</span><input
                                                                type="checkbox" data-role="flipswitch"
                                                                name="radio-enable" id="radio-enable" checked="checked"
                                                                data-mini="true" class="ui-flipswitch-input"
                                                                tabindex="-1"></div>
                                                </div>
                                            </div>
                                            <div class="col col-2-3">
                                                <div class="control-field control-field-disableable">
                                                    <fieldset data-role="controlgroup" data-type="horizontal"
                                                              data-mini="true"
                                                              class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                        <div role="heading" class="ui-controlgroup-label">
                                                            <legend>Type</legend>
                                                        </div>
                                                        <div class="ui-controlgroup-controls ">

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="radio-type-buttons"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-first-child"><span
                                                                            class="icon icon-16 icon-square-rounded-small"
                                                                            title="buttons">&nbsp;</span></label><input
                                                                        type="radio" name="radio-type"
                                                                        id="radio-type-buttons" value="button"
                                                                        checked="checked"></div>

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="radio-type-thumbnails"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                            class="icon icon-16 icon-rectangle-rounded-small"
                                                                            title="thumbnails">&nbsp;</span></label><input
                                                                        type="radio" name="radio-type"
                                                                        id="radio-type-thumbnails" value="thumbnail">
                                                            </div>

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="col col-1-2">
                                                <div class="control-field control-field-disableable">
                                                    <fieldset data-role="controlgroup" data-type="horizontal"
                                                              data-mini="true"
                                                              class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                        <div role="heading" class="ui-controlgroup-label">
                                                            <legend>Shape</legend>
                                                        </div>
                                                        <div class="ui-controlgroup-controls ">

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="radio-shape-square"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-first-child"><span
                                                                            class="icon icon-12 icon-radio-square"
                                                                            title="square">&nbsp;</span></label><input
                                                                        type="radio" name="radio-shape"
                                                                        id="radio-shape-square" value="square"></div>

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="radio-shape-rounded"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active"><span
                                                                            class="icon icon-12 icon-radio-rounded"
                                                                            title="rounded square">&nbsp;</span></label><input
                                                                        type="radio" name="radio-shape"
                                                                        id="radio-shape-rounded" value="rounded"
                                                                        checked="checked"></div>

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="radio-shape-circle"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                            class="icon icon-12 icon-radio-circle"
                                                                            title="circular">&nbsp;</span></label><input
                                                                        type="radio" name="radio-shape"
                                                                        id="radio-shape-circle" value="circle"></div>

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="col col-1-2">
                                                <div class="control-field control-field-disableable">
                                                    <fieldset data-role="controlgroup" data-type="horizontal"
                                                              data-mini="true"
                                                              class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                        <div role="heading" class="ui-controlgroup-label">
                                                            <legend>Align</legend>
                                                        </div>
                                                        <div class="ui-controlgroup-controls ">

                                                            <div class="ui-radio ui-mini"><label for="radio-align-left"
                                                                                                 class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-first-child"><span
                                                                            class="icon icon-16 icon-radio-align-left"
                                                                            title="left align">&nbsp;</span></label><input
                                                                        type="radio" name="radio-align"
                                                                        id="radio-align-left" value="left"></div>

                                                            <div class="ui-radio ui-mini"><label
                                                                        for="radio-align-center"
                                                                        class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active"><span
                                                                            class="icon icon-16 icon-radio-align-center"
                                                                            title="center align">&nbsp;</span></label><input
                                                                        type="radio" name="radio-align"
                                                                        id="radio-align-center" value="center"
                                                                        checked="checked"></div>

                                                            <div class="ui-radio ui-mini"><label for="radio-align-right"
                                                                                                 class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                            class="icon icon-16 icon-radio-align-right"
                                                                            title="right align">&nbsp;</span></label><input
                                                                        type="radio" name="radio-align"
                                                                        id="radio-align-right" value="right"></div>

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="control-field control-field-disableable">
                                                <fieldset data-role="controlgroup" data-type="horizontal"
                                                          data-mini="true"
                                                          class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all ui-mini">
                                                    <div role="heading" class="ui-controlgroup-label">
                                                        <legend>Color</legend>
                                                    </div>
                                                    <div class="ui-controlgroup-controls ">

                                                        <div class="ui-radio ui-mini"><label for="radio-color-white"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-first-child"><span
                                                                        class="icon icon-16 icon-white" title="white">&nbsp;</span></label><input
                                                                    type="radio" name="radio-color"
                                                                    id="radio-color-white" value="white"
                                                                    checked="checked"></div>

                                                        <div class="ui-radio ui-mini"><label for="radio-color-black"
                                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                        class="icon icon-16 icon-black" title="black">&nbsp;</span></label><input
                                                                    type="radio" name="radio-color"
                                                                    id="radio-color-black" value="black"></div>

                                                        <div class="ui-radio ui-mini"><label
                                                                    for="radio-color-white-border"
                                                                    class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off"><span
                                                                        class="icon icon-16 icon-black-white-border"
                                                                        title="white border">&nbsp;</span></label><input
                                                                    type="radio" name="radio-color"
                                                                    id="radio-color-white-border" value="white-border">
                                                        </div>

                                                        <div class="ui-radio ui-mini"><label
                                                                    for="radio-color-black-border"
                                                                    class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child"><span
                                                                        class="icon icon-16 icon-white-black-border"
                                                                        title="black border">&nbsp;</span></label><input
                                                                    type="radio" name="radio-color"
                                                                    id="radio-color-black-border" value="black-border">
                                                        </div>

                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="controls-group controls-group-ad">
                                    </div>
                                    <button type="button" class="reset-all-button ui-btn ui-shadow ui-corner-all"><span
                                                class="icon icon-16 icon-reset" title="reset all">&nbsp;</span> Reset
                                        all
                                    </button>

                                    <div class="social-buttons">

                                        <div id="fb-root"></div>
                                        <script>(function (d, s, id) {
                                                var js, fjs = d.getElementsByTagName(s)[0];
                                                if (d.getElementById(id)) return;
                                                js = d.createElement(s);
                                                js.id = id;
                                                js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=356606661162641&version=v2.0";
                                                fjs.parentNode.insertBefore(js, fjs);
                                            }(document, 'script', 'facebook-jssdk'));</script>

                                        <a href="https://twitter.com/share" class="twitter-share-button ui-link"
                                           data-lang="en" data-count="none" style="vertical-align:top;">Tweet</a>
                                        <script>!function (d, s, id) {
                                                var js, fjs = d.getElementsByTagName(s)[0];
                                                if (!d.getElementById(id)) {
                                                    js = d.createElement(s);
                                                    js.id = id;
                                                    js.src = "https://platform.twitter.com/widgets.js";
                                                    fjs.parentNode.insertBefore(js, fjs);
                                                }
                                            }(document, "script", "twitter-wjs");</script>
                                        <div class="fb-like"
                                             data-href="http://imageslidermaker.com/blog/how-to-make-a-responsive-image-slider-using-jquery-and-css"
                                             data-layout="button" data-action="like" data-show-faces="false"
                                             data-share="true" style="vertical-align:top;"></div>

                                    </div>


                                </div>
                                <!-- end of col 3 -->

                                <div class="clear"></div>

                            </div> <!-- end of look-and-feel controls -->

                        </div> <!-- end of tool container -->

                        <div class="container intro">

                            <h1>Image Slider Maker Free Generator Tool</h1>
                            <h2>Generate your jQuery CSS3 content slider</h2>

                            <p>To get started, use the controls above to adjust your design, upload your own images and
                                use the <em>Download Zip</em> button to get the generated code. Please consult the <a
                                        href="#doc-intro" data-ajax="false" class="ui-link">documentation</a> below if
                                you need guidance.</p>

                            <!--
                            <div class="ad-container ad-container-center">
                              include ad-v2-top
                            </div>
                            -->

                        </div> <!-- end of intro -->

                        <div class="container generated-output">

                            <div class="download-and-example">
                                <div class="col col-1-2 col-pad-right">
                                    <form method="POST" action="#" data-ajax="false" class="zip-form">
                                        <button type="submit" data-mini="false" data-wrapper-class="zip-button"
                                                class=" ui-btn ui-shadow ui-corner-all"><span
                                                    class="icon icon-32 icon-download" title="download">&nbsp;</span>
                                            Download Zip
                                        </button>
                                    </form>
                                    <div class="panel zip-options-panel panel-hidden" style="display: none;">
                                        <p class="cookie-warning" style="display:none;">Cookies must be enabled</p>
                                        <a href="#" data-role="button" data-theme="a" data-icon="delete"
                                           data-iconpos="notext"
                                           class="panel-close-button ui-link ui-btn ui-btn-a ui-icon-delete ui-btn-icon-notext ui-shadow ui-corner-all"
                                           role="button">Close</a>
                                        <!--
                                                      <input type="checkbox" name="zip-email" id="zip-email-checkbox">
                                                      <label for="zip-email-checkbox">Email the zip to me</label>
                                                      <div class="email-details" style="display: none;">
                                                        <input type="text" name="email" placeholder="your email address">
                                                      </div>
                                        -->
                                        <a data-role="button" href="/imageslidermaker.zip" rel="nofollow" id="zip-link"
                                           data-ajax="false" class="ui-link ui-btn ui-shadow ui-corner-all"
                                           role="button">Download Now</a>
                                        <button id="dummy-download-now-button" type="button" data-disabled="true"
                                                style="display:none;" class=" ui-btn ui-shadow ui-corner-all"><strike>Download
                                                Now</strike></button>
                                        <p id="zip-email-note" style="display: none;">* emails containing zip files can
                                            sometimes be delayed by email providers</p>
                                    </div>
                                    <div class="panel email-zip-confirm-panel panel-hidden" style="display: none;">
                                        <a href="#" data-role="button" data-theme="a" data-icon="delete"
                                           data-iconpos="notext"
                                           class="panel-close-button ui-link ui-btn ui-btn-a ui-icon-delete ui-btn-icon-notext ui-shadow ui-corner-all"
                                           role="button">Close</a>
                                        <p>We have emailed your slider to you</p>
                                    </div>
                                </div>
                                <div class="col col-1-2 col-pad-left">
                                    <form method="POST" action="#" data-ajax="false" class="example-form"
                                          style="display: block;">
                                        <button type="submit" data-mini="false" data-wrapper-class="example-button"
                                                class=" ui-btn ui-shadow ui-corner-all">Preview my slider in a page
                                            <span class="icon icon-32 icon-example" title="example">&nbsp;</span>
                                        </button>
                                    </form>
                                    <div class="panel example-options-panel" style="display: none;">
                                        <a href="#" data-role="button" data-theme="a" data-icon="delete"
                                           data-iconpos="notext"
                                           class="panel-close-button ui-link ui-btn ui-btn-a ui-icon-delete ui-btn-icon-notext ui-shadow ui-corner-all"
                                           role="button">Close</a>
                                        <fieldset data-role="controlgroup" data-type="horizontal"
                                                  class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all">
                                            <div role="heading" class="ui-controlgroup-label">
                                                <legend>Page Layout</legend>
                                            </div>
                                            <div class="ui-controlgroup-controls ">

                                                <div class="ui-radio"><label for="page-layout-column"
                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-first-child ui-radio-off">column</label><input
                                                            type="radio" name="page-layout" id="page-layout-column"
                                                            value="c" checked="checked" data-cacheval="true"></div>

                                                <div class="ui-radio"><label for="page-layout-full-width"
                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-last-child ui-btn-active ui-radio-on">full
                                                        width</label><input type="radio" name="page-layout"
                                                                            id="page-layout-full-width" value="f"
                                                                            data-cacheval="false"></div>

                                            </div>
                                        </fieldset>
                                        <fieldset data-role="controlgroup" data-type="horizontal"
                                                  class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all">
                                            <div role="heading" class="ui-controlgroup-label">
                                                <legend>Background Color</legend>
                                            </div>
                                            <div class="ui-controlgroup-controls ">

                                                <div class="ui-radio"><label for="page-bg-white"
                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-on ui-btn-active ui-first-child">white</label><input
                                                            type="radio" name="page-bg" id="page-bg-white" value="w"
                                                            checked="checked"></div>

                                                <div class="ui-radio"><label for="page-bg-black"
                                                                             class="ui-btn ui-corner-all ui-btn-inherit ui-radio-off ui-last-child">black</label><input
                                                            type="radio" name="page-bg" id="page-bg-black" value="b">
                                                </div>

                                            </div>
                                        </fieldset>
                                        <a data-role="button" href="/example.html?l=f&amp;b=w" target="_blank"
                                           rel="nofollow" id="example-link" data-ajax="false"
                                           class="ui-link ui-btn ui-shadow ui-corner-all" role="button">Show me</a>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div> <!-- end of download-and-exmaple -->

                            <p class="pointer-advice">Use this button to download your slider code — everything you need
                                is contained in the zip file.</p>

                            <div class="help-tools">
                                <a class="help ui-link" href="#doc-download"
                                   title="Learn about how to download and test your generated slider" data-ajax="false">?</a>
                            </div>

                            <div data-role="collapsible" data-collapsed="true"
                                 class="ui-collapsible ui-collapsible-inset ui-corner-all ui-collapsible-themed-content ui-collapsible-collapsed">
                                <h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed"><a href="#"
                                                                                                       class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-left ui-btn-inherit ui-icon-plus">Zip
                                        file contents<span class="ui-collapsible-heading-status"> click to expand contents</span></a>
                                </h3>
                                <div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed"
                                     aria-hidden="true">

                                    <div class="info">
                                        <ul>
                                            <li>ism/</li>
                                            <ul>
                                                <li>css/</li>
                                                <ul>
                                                    <li>my-slider.css</li>
                                                </ul>
                                                <li>js/</li>
                                                <ul>
                                                    <li><a href="ism/js/ism-2.2.min.js" data-ajax="false"
                                                           class="ui-link">ism-2.2.min.js</a></li>
                                                </ul>
                                                <li>image/</li>
                                                <ul>
                                                    <li>slides/</li>
                                                    <ul id="dir-structure-images">
                                                        <li><a href="/ism/image/slides/flower-729514_1280.jpg"
                                                               target="_blank"
                                                               data-ajax="false">flower-729514_1280.jpg</a></li>
                                                        <a href="/ism/image/slides/flower-729514_1280.jpg"
                                                           target="_blank" data-ajax="false">
                                                        </a>
                                                        <li><a href="/ism/image/slides/flower-729514_1280.jpg"
                                                               target="_blank" data-ajax="false"></a><a
                                                                    href="/ism/image/slides/beautiful-701678_1280.jpg"
                                                                    target="_blank" data-ajax="false">beautiful-701678_1280.jpg</a>
                                                        </li>
                                                        <a href="/ism/image/slides/beautiful-701678_1280.jpg"
                                                           target="_blank" data-ajax="false">
                                                        </a>
                                                        <li><a href="/ism/image/slides/beautiful-701678_1280.jpg"
                                                               target="_blank" data-ajax="false"></a><a
                                                                    href="/ism/image/slides/summer-192179_1280.jpg"
                                                                    target="_blank" data-ajax="false">summer-192179_1280.jpg</a>
                                                        </li>
                                                        <a href="/ism/image/slides/summer-192179_1280.jpg"
                                                           target="_blank" data-ajax="false">
                                                        </a></ul>
                                                </ul>
                                            </ul>
                                        </ul>
                                    </div> <!-- end of info -->
                                </div>
                            </div>

                            <div data-role="collapsible" data-collapsed="true"
                                 class="ui-collapsible ui-collapsible-inset ui-corner-all ui-collapsible-themed-content ui-collapsible-collapsed">
                                <h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed"><a href="#"
                                                                                                       class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-left ui-btn-inherit ui-icon-plus">Markup
                                        preview<span
                                                class="ui-collapsible-heading-status"> click to expand contents</span></a>
                                </h3>
                                <div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed"
                                     aria-hidden="true">


                                    <div class="help-tools">
                                        <a class="help ui-link" href="#doc-output"
                                           title="Learn about the outputted code textareas" data-ajax="false">?</a>
                                    </div>

                                    <p>Here's the generated HTML and CSS:</p>

                                    <div class="output">
                                        <div class="col col-3-4">
                                            <label for="output-head-html">HTML to paste into head:</label>
                                        </div>
                                        <div class="col col-1-4">
                                            <button data-role="button" type="button" data-mini="true"
                                                    data-wrapper-class="select-all-button"
                                                    class="output-select-button ui-btn ui-shadow ui-corner-all ui-mini">
                                                <span class="icon icon-16 icon-select-all"
                                                      title="select all">&nbsp;</span> Select all
                                            </button>
                                        </div>
                                        <div class="clear"></div>
                                        <textarea name="output-head-html" id="output-head-html" value=""
                                                  data-autogrow="false" spellcheck="false"
                                                  class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all"></textarea>
                                    </div>

                                    <div class="output">
                                        <div class="col col-3-4">
                                            <label for="output-body-html">HTML to paste into body:</label>
                                        </div>
                                        <div class="col col-1-4">
                                            <button data-role="button" type="button" data-mini="true"
                                                    data-wrapper-class="select-all-button"
                                                    class="output-select-button ui-btn ui-shadow ui-corner-all ui-mini">
                                                <span class="icon icon-16 icon-select-all"
                                                      title="select all">&nbsp;</span> Select all
                                            </button>
                                        </div>
                                        <div class="clear"></div>
                                        <textarea name="output-body-html" id="output-body-html" value=""
                                                  data-autogrow="false" spellcheck="false"
                                                  class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all"></textarea>
                                    </div>

                                    <div class="output">
                                        <div class="col col-3-4">
                                            <label for="output-css">CSS (save as my-slider.css):</label>
                                        </div>
                                        <div class="col col-1-4 col-align-right">
                                            <button data-role="button" type="button" data-mini="true"
                                                    data-wrapper-class="select-all-button"
                                                    class="output-select-button ui-btn ui-shadow ui-corner-all ui-mini">
                                                <span class="icon icon-16 icon-select-all"
                                                      title="select all">&nbsp;</span> Select all
                                            </button>
                                        </div>
                                        <div class="clear"></div>
                                        <textarea name="output-css" id="output-css" value="" data-autogrow="false"
                                                  spellcheck="false"
                                                  class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all"></textarea>
                                    </div>

                                </div>
                            </div>

                        </div> <!-- end of generated-output -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

