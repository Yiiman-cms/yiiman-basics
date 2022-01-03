<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 *
 * Site:https://yiiman.ir
 * Date: 12/30/2018
 * Time: 4:09 AM
 */

/**
 * @var $this \yii\web\View
 * @var $id            string
 * @var $label         string
 * @var $name          string
 * @var $value         string
 * @var $attribute     string
 * @var $model         \YiiMan\YiiBasics\modules\gallery\models\GalleryMedias[]
 */

use YiiMan\YiiBasics\modules\filemanager\assets\FileManagerAsset;

use yii\bootstrap\Modal;
use yii\helpers\BaseHtml;
use yii\web\View;

$modal = $id . 'Modal';
$idWidget = $id . 'Widget';
$id=uniqid();

\YiiMan\YiiBasics\modules\gallery\widgets\LightBoxAssets::register($this);
$this->registerJs('var selectMediaArray=\'\';', View::POS_HEAD);
$removeUrl = Yii::$app->urlManager->createUrl(['/gallery/gallery-medias/remove-media']);
$checkDefaultUrl = Yii::$app->urlManager->createUrl(['/gallery/gallery-medias/check-default-media']);
$setDefaultUrl = Yii::$app->urlManager->createUrl(['/gallery/gallery-medias/add-default-media']);
$js = <<<JS
	$(document).ready(function() {
	      lightGallery(document.getElementById('lightgallery$id'),
	      {
	          removeUrl:'{$removeUrl}',
	          checkDefaultUrl:'{$checkDefaultUrl}',
	          setDefaultUrl:'{$setDefaultUrl}',
	          videojs: true
	      });
	});
JS;
$this->registerJs($js, View::POS_END);
\YiiMan\YiiBasics\modules\gallery\widgets\VideoPlayerAsset::register($this);
?>

<style>
    video ~ span {
        display: block;
        position: absolute;
        top: 0;
        z-index: 9999;
        height: 30px;
        width: 30px;
        background: rgba(38, 7, 7, 0.45);
    }

    video ~ span > .fa.fa-trash {
        padding: 8px;
        font-size: 15px;
        color: white;
    }
</style>



<?php
if (!function_exists('galEcho')) {
    function galEcho($url,$class)
    {
        $src = $url;
        $src = explode('/', $src);
        $src = $src[count($src) - 1];
        $extension = explode('.', $src);
        if (!empty($extension)) {
            $extension[count($extension) - 1];
        }


        ?>
        <li class="col-xs-6 col-sm-4 col-md-3 <?= $class ?>" data-src="<?= $url ?>" data-sub-html="" data-pinterest-text=""
            data-tweet-text="">
            <a href="">
                <?php
                switch (Yii::$app->UploadManager->extensionsToMime($extension[count($extension) - 1])) {
                    case 'image':
                        ?>
                        <img class="img-responsive" src="<?= $url ?>">
                        <?php
                        break;
                    case 'video':
                        ?>
                        <video class="lg-video-object lg-html5 video-js vjs-default-skin" controls preload="none">
                            <source src="<?= $url ?>" type="video/<?= $extension[count($extension) - 1] ?>">
                        </video>
                        <span class="video-remove" src="<?= $url ?>"><i class="fa fa-trash"></i></span>
                        <?php
                        break;
                }
                ?>

            </a>
        </li>
        <?php
    }
}


?>
<style>
    .demo-gallery > ul {
        margin: auto;
        padding: 0;
        display: inline;
    }

    .demo-gallery > ul > li {
        float: right;
        margin-bottom: auto;
        margin-right: auto;
        width: 200px;
        margin-left: auto;
        display: block;
        margin-bottom: 20px;
    }
</style>
<div class="demo-gallery">
    <ul id="lightgallery<?= $id ?>" class="list-unstyled row lightgallery-parent">
        <?php

        if (empty($model)) {
            echo '<p>فایلی ثبت نشده است</p>';
        } else {
            foreach ($model as $item) {

                /**
                 * @var \YiiMan\YiiBasics\modules\gallery\models\GalleryMedias $item
                 */
                $url = Yii::$app->Options->UploadUrl . '/dl/' . $item->className . '/' . $item->file_name . $item->extension;
                $class=!empty($item->default)?'default-pic':'';
                galEcho($url,$class);
            }
        }
        ?>
    </ul>
</div>




