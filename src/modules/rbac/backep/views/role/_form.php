<?php
	
	use kartik\select2\Select2;
	use system\widgets\floara\FroalaEditorWidget;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	
	/**
	 * @var $pages  \YiiMan\YiiBasics\modules\rbac\models\Pages[]
	 * @var $access []
	 */
?>

<div class="role-form">
	
	<?php $form = ActiveForm::begin(); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card card-nav-tabs">
				<div class="card-body ">
					<h4 class="text-center"></h4>
					<div class="row">
						<div class="col-lg-4">
							<?= $form->field( $model , 'name' )->textInput( [ 'maxlength' => true ] ); ?>
						</div>
						<div class="col-lg-8">
							<?= $form->field( $model , 'description' )->textarea() ?>
						</div>
						<div class="col-lg-8">
							<?= $form->field( $model , 'access' )->widget(
								Select2::className() ,
								[
									'name'    => 'access' ,
									'data'    => ArrayHelper::map( $pages , 'id' , 'desc' ) ,
									'value'   => $access ,
									'options' =>
										[
											'placeholder' => Yii::t( 'app' , 'Choose...' ) ,
											'multiple'    => true ,
											'dir'         => 'rtl'
										] ,
								]
							)
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="form-group">
		<?= Html::submitButton( Yii::t( 'backend' , 'Submit' ) , [ 'class' => 'btn btn-success' ] ) ?>
	</div>
	
	<?php ActiveForm::end(); ?>

</div>
