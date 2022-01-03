<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: 12/30/2018
 * Time: 4:09 AM
 */

/**
 * @var $this          \yii\web\View
 * @var $id            string
 * @var $label         string
 * @var $name          string
 * @var $value         string
 * @var $attribute     string
 * @var $model         \yii\db\ActiveRecord
 */

use YiiMan\YiiBasics\modules\filemanager\assets\FileManagerAsset;
use YiiMan\YiiBasics\modules\filemanager\assets\LightBoxAssets;
use yii\bootstrap\Modal;
use yii\helpers\BaseHtml;
use yii\web\View;

$modal = $id.'Modal';
$idWidget = $id.'Widget';
$UploadUrl = Yii::$app->Options->UploadUrl;
$inputId = BaseHtml::getInputId($model, $attribute);
LightBoxAssets::register($this);
$this->registerJs('var selectMediaArray=\'\';', View::POS_HEAD);

$js = <<<JS
	var hasMedia$id ='';
	$('body').prepend(
	     "<div id='$modal' class='media-modal fade modal' role='dialog' tabindex='-1'>"+
				"<div class='modal-dialog '>"+
						"<div class='modal-content'>"+
							"<div class='modal-header'>"+
									"<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>"+
							"</div>"+
							"<div class='modal-body'>"+
							"<style>"+
								"iframe {"+
									"height: 70vh;"+
									"width: 100%;"+
								"}"+
							"</style>"+
							"<iframe src='/backend/filemanager/default/widget-iframe' width='100' height='100' frameborder='0'></iframe>"+
							"<button class='btn btn-success btn-media-select' >انتخاب</button></div><input type='hidden' class='files-value' value='' name='sd'>"+
						"</div>"+
				"</div>"+
		 "</div>"
	);

	var selects;
if (typeof window.addEventListener != 'undefined') {
 
		    window.addEventListener('message', function(e) {
		        selects = e.data[1];
		        
		    }, false);
		} else if (typeof window.attachEvent != 'undefined') { // this part is for IE8
		    window.attachEvent('onmessage', function(e) {
		        selects = e.data; // you'll probably have to play around with this part as I can't remember exactly how it comes across in IE8 -- i think it will involve slice() iirc
		     
		    });
		}

	$('.btn-media-select').click(function() {
	
		$('#$inputId').val(selects);
		$('#lightgallery$id').empty();
		$('#gallery$id').append('<div class="demo-gallery"><ul id="lightgallery$id" class="list-unstyled row"></ul></div>');
		
		var items=selects.split(' ');
		$.each(items,function(index,data){
		    if (data.length>1){
				$('#lightgallery$id').append('<li class="col-xs-6 col-sm-4 col-md-3"  data-src="$UploadUrl'+data+'" data-sub-html="" data-pinterest-text=""><a href=""><img class="img-responsive" src="$UploadUrl'+data+'" alt="Thumb-1"></a></li>');
		    }
		});
		lightGallery(document.getElementById('lightgallery$id'));
		$('#$modal').modal('hide');
	})
	$(document).ready(function() {
	  if (hasMedia$id){
	      lightGallery(document.getElementById('lightgallery$id'));
	  }
	});
JS;
$this->registerJs($js, View::POS_END);
?>

<div class="row">
    <div class="col-md-12" id="gallery<?= $id ?>">
        <?php
        if (!empty($model->{$attribute})) {

            $items = explode(' ', $model->{$attribute});
            ?>
            <script>
                var hasMedia<?= $id ?>= 'yes';
            </script>
            <div class="demo-gallery">
                <ul id="lightgallery<?= $id ?>" class="list-unstyled row">
                    <?php
                    foreach ($items as $item) {
                        if (!empty($item)) {

                            ?>
                            <li class="col-xs-6 col-sm-4 col-md-3" data-src="<?= $UploadUrl.'/'.$item ?>"
                                data-sub-html="" data-pinterest-text="" data-tweet-text="">
                                <a href="">
                                    <img class="img-responsive" src="<?= $UploadUrl.'/'.$item ?>">
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="input-group">
            <?= \yii\helpers\Html::activeInput('hidden', $model, $attribute, []); ?>

            <span class="input-group-btn">
         <button class="btn btn-primary" type="button" data-toggle="modal"
                 data-target="#<?= $modal ?>">
	         <i class="fa fa-folder-open"></i>انتخاب <?= $label ?>
         </button>
    </span>
        </div>
    </div>
</div>

