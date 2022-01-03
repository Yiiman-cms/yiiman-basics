<?php
	
	use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
	use yii\helpers\Html;
	use yii\grid\GridView;
	use yii\widgets\Pjax;
	
	/* @var $this yii\web\View */
	/* @var $searchModel YiiMan\YiiBasics\modules\testimotional\models\SearchTestimotional */
	/* @var $dataProvider yii\data\ActiveDataProvider */
	
	$this->title                   = Yii::t( 'testimotional' , 'Testimotional' ) . ' ';
	$this->params['breadcrumbs'][] = $this->title;
	$this->registerJs( $this->render( 'script/app.js' ) , $this::POS_END );
?>
<p>
	<?= Html::a(
		Yii::t( 'testimotional' , 'Add Testimotional' ) ,
		[ 'create' ] ,
		[ 'class' => 'btn btn-success' , 'id' => 'create' ]
	) ?>
</p>
<div class="row">
	<?php
		if ( ! empty( $dataProvider->models ) ) {
			foreach ( $dataProvider->models as $model ) {
				/**
				 * @var $model \YiiMan\YiiBasics\modules\testimotional\models\Testimotional
				 */
				?>
				<div class="col-md-4">
					<div class="card card-nav-tabs">
						<div class="card-body ">
							<h4 class="text-center"><?= $model->author ?></h4>
							<hr>
							<div class="row">
								<div class="col-md-12 pull-right">
									<div class="row">
										<div class="col-md-12">
											<img src="<?= Yii::$app->UploadManager->getImageUrl(
												$model ,
												'image'
											) ?>"
											     class="img center-block center-align img-thumbnail img-circle"
											     style="width: 100px;height: 100px" alt="">
										</div>
									</div>
									<h5>Content:</h5>
									
									<div class="row">
										<div class="col-md-12">
											<?= $model->content ?>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-12">
											Status:<?= $model->status == $model::STATUS_ACTIVE ? '<span style="color:green">Published</span>' : '<span style="color: red">Review</span>' ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<a
													href="<?= Yii::$app->urlManager->createUrl(
														[ '/testimotional/default/delete?id=' . $model->id ]
													) ?>" class="btn btn-danger btn-round"
													data-confirm="Are you sure you want to delete this item?"
													data-method="post"><span
														class="glyphicon glyphicon-trash"></span></a>
										</div>
										<div class="col-md-4"></div>
										<div class="col-md-4">
											<a title="Update" aria-label="Update" data-pjax="0"
											   href="<?= Yii::$app->urlManager->createUrl(
												   [ '/testimotional/default/update?id=' . $model->id ]
											   ) ?>"
											   class="btn btn-success btn-round pull-right"><span
														class="glyphicon glyphicon-pencil"></span></a>
										</div>
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
