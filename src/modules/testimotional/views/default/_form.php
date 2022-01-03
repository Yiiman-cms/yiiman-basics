<?php
	
	use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
	use YiiMan\YiiBasics\modules\testimotional\models\Testimotional;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use kartik\select2\Select2;
	
	/* @var $this yii\web\View */
	/* @var $model YiiMan\YiiBasics\modules\testimotional\models\Testimotional */
	/* @var $form yii\widgets\ActiveForm */
?>

<div class="testimotional-form">
	
	<?php $form = ActiveForm::begin(); ?>
	<div class="row">
		<div class="col-md-4">
			<div class="card card-nav-tabs">
				<div class="card-body ">
					<h4 class="text-center">Status</h4>
					<div class="row">
						<div class="col-md-12 pull-right">
							<?= $form->field( $model , 'status' )->widget(
								Select2::className() ,
								[
									'data' =>
										[
											Testimotional::STATUS_ACTIVE    => 'Publish' ,
											Testimotional::STATUS_DE_ACTIVE => 'Review'
										]
								]
							) ?>
						</div>
						<div class="col-md-12">
							<?php
								if (!empty( $model->image)){
									?>
									<img class="img img-circle center-block" src="<?= Yii::$app->UploadManager->getImageUrl( $model , 'image','150*150') ?>" alt="">
							<?php
								}
							?>
							<?= $form->field( $model , 'image')->fileInput() ?>
						</div>
						<div class="col-md-12">
							<button class="btn btn-success" type="submit">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card card-nav-tabs">
				<div class="card-body ">
					<h4 class="text-center">Properties</h4>
					<div class="row">
						<div class="col-md-12 pull-right">
							<div class="col-md-12" style="margin-top:20px">
								<?= $form->field( $model , 'author' )->textInput( [ 'maxlength' => true ] ) ?>
							</div>
							
							<div class="col-md-12" style="margin-top:20px">
								<?= $form->field( $model , 'job' )->textInput( [ 'maxlength' => true ] ) ?>
							</div>
							
							<div class="col-md-12" style="margin-top:20px">
								<?= $form->field( $model , 'content' )->widget(
									\system\widgets\floara\FroalaEditorWidget::className() ,
									[]
								) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php ActiveForm::end(); ?>

</div>
