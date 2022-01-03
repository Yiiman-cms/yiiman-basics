<?php
	/**
	 * Created by YiiMan TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
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
	 * @var $model         \yii\db\ActiveRecord
	 */
	
	use YiiMan\YiiBasics\modules\filemanager\assets\FileManagerAsset;
	use YiiMan\YiiBasics\modules\filemanager\assets\LightBoxAssets;
	use yii\bootstrap\Modal;
	use yii\helpers\BaseHtml;
	use yii\web\View;
	
	$modal     = $id . 'Modal';
	$idWidget  = $id . 'Widget';
	$UploadUrl=Yii::$app->Options->UploadUrl.'/'. (new \ReflectionClass($model))->getShortName().'/'.$model->id.'/';
	
	
	$inputId=BaseHtml::getInputId( $model , $attribute);
	LightBoxAssets::register( $this);
	$this->registerJs( 'var selectMediaArray=\'\';',View::POS_HEAD);
	
	$js=<<<JS
	$(document).ready(function() {
	      lightGallery(document.getElementById('lightgallery$id'));
	});
JS;
$this->registerJs( $js,View::POS_END);
	?>


	<?php
		if (!function_exists( 'galEcho')){
			function galEcho($url){
				?>
				<li class="col-xs-6 col-sm-4 col-md-3"  data-src="<?= $url ?>" data-sub-html="" data-pinterest-text="" data-tweet-text="">
					<a href="">
						<img class="img-responsive" src="<?= $url ?>">
					</a>
				</li>
				<?php
			}
		}
		if (!empty( $model->{$attribute})){
			
			$items=explode( ' ' , $model->{$attribute});
			?>
			<style>
				.demo-gallery > ul {
					margin: auto;
					padding: 0;
					display: block;
				}
				.demo-gallery > ul > li {
					float: none;
					margin-bottom: auto;
					margin-right: auto;
					width: 200px;
					margin-left: auto;
				}
			</style>
			<div class="demo-gallery">
				<ul id="lightgallery<?= $id ?>" class="list-unstyled row">
					<?php
						if (empty($count)){
							foreach($items as $item){
								if (!empty( $item)){
									galEcho($UploadUrl.'/'.$item);
								}
							}
						}else{
							for ($i=0;$i<=$count;$i++){
								if (!empty( $items[$i])){
									galEcho($UploadUrl.'/'. $items[$i]);
								}
							}
						}
					?>
				</ul>
			</div>
		<?php
		}
		
	?>



