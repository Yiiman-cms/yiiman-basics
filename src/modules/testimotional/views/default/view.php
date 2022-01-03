<?php
	
	use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
	use yii\helpers\Html;
	use yii\widgets\DetailView;
	
	/* @var $this yii\web\View */
	/* @var $model YiiMan\YiiBasics\modules\testimotional\models\Testimotional */
	
	$this->title                   = $model->id;
	$this->params['breadcrumbs'][] = [ 'label' => Yii::t( 'testimotional' , 'Testimotionals' ) , 'url' => [ 'index' ] ];
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testimotional-view">
	
	<div class="row">
		<div class="col-md-12 ">
			<div class="card card-nav-tabs">
				<div class="card-body ">
					<h4 class="text-center"></h4>
					<div class="row">
						<div class="col-md-12 pull-right">
							<img src="<?= Yii::$app->UploadManager->getImageUrl( $model , 'image' , '100*100' ) ?>"
							     class="center-block img-circle img " style="width: 100px;height: 100px" alt="">
						</div>
						<div class="col-md-12" style="margin-top: 20px">
							<div class="text-center">
								<?= $model->content ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?= DetailView::widget(
		[
			'model'      => $model ,
			'attributes' =>
				[
					'author' ,
					'job' ,
				] ,
		]
	) ?>

</div>
