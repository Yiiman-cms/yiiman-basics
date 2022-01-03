<?php
	
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	
	/* @var $this yii\web\View */
	/* @var $model \YiiMan\YiiBasics\modules\rbac\models\AuthItem */
	/* @var $form yii\widgets\ActiveForm */
	$this->title=Yii::t( 'rbac' , 'create Rule');
?>

<div class="auth-item-form">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-nav-tabs">
				<div class="card-body ">
					<h4 class="text-center"></h4>
					<div class="row">
						<div class="col-md-12 pull-right">
							<?php $form = ActiveForm::begin(); ?>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field( $model , 'name' )->textInput( [ 'maxlength' => true ] ) ?>
								</div>
								<div class="col-md-6">
									<?= $form->field( $model , 'className' )->textInput( [ 'maxlength' => true ] ) ?>
								</div>
							</div>
							
							<?php if ( ! Yii::$app->request->isAjax ) { ?>
								<div class="form-group">
									<?= Html::submitButton(
										Yii::t( 'rbac' , 'Save' ) ,
										[ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ]
									) ?>
								</div>
							<?php } ?>
							
							<?php ActiveForm::end(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
