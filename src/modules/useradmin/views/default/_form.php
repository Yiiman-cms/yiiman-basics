<?php
	
	use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
	use YiiMan\YiiBasics\modules\setting\widgets\ImageField;
	use YiiMan\YiiBasics\modules\useradmin\models\User;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use kartik\select2\Select2;
	
	/* @var $this yii\web\View */
	/* @var $model YiiMan\YiiBasics\modules\useradmin\models\User */
	/* @var $form yii\widgets\ActiveForm */
	
	$form = ActiveForm::begin();
	$js   = <<<JS
		 var duplicate=false;
		 $('#searchuser-username').keyup(function(e) {
		   e.preventDefault();
		   let variable=$(this).val();
		   var data={val:variable};
		   $.ajax({
		           url: backend+'/user/default/check-duplicate',
		           type: 'post',
		           data: data,
		       }).done(function (data) {
		           if (data.status==='duplicate') {
		               duplicate=true;
		                setTimeout(function(){
		           			$('.field-searchuser-username').addClass('has-error');
		       			},100);
		               $('.field-searchuser-username').removeClass('has-success');
		               $('.field-searchuser-username .help-block').text('THis User Exist, Can Not Use This Name');
		           }else{
		              duplicate=false;
		               $('.field-searchuser-username').removeClass('has-error');
		               $('.field-searchuser-username').addClass('has-success');
		               $('.field-searchuser-username .help-block').empty();
		           }
		       });
		 });
		 $('button').click(function(e) {
		   if (duplicate){
		       e.preventDefault();
		       setTimeout(function(){
		           $('.field-searchuser-username').addClass('has-error');
		       },100);
		       
		   }
		 })
JS;
	$this->registerJs( $js , $this::POS_END );
?>
<div class="row">
	<div class="col-md-4">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12" style="margin-top:20px">
						<div class="card card-nav-tabs">
							<div class="card-body ">
								<h4 class="text-center"><?= \Yii::t('useradmin','آواتار') ?></h4>
								<div class="row">
									<div class="col-md-12 pull-right">
										<?php
											if (!empty( $model->image)){
												?>
												<img class="img img-circle center-block" src="<?= Yii::$app->UploadManager->getImageUrl( $model , 'image','150*150') ?>" alt="">
												<?php
											}
										?>
										<?= $form->field( $model , 'image')->fileInput() ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 pull-right" style="margin-top:20px;width: 100%">
						<div class="card card-nav-tabs">
							<div class="card-body ">
								<h4 class="text-center"><?= \Yii::t('useradmin','وضعیت حساب کاربری') ?></h4>
								<div class="row">
									<div class="col-md-12 pull-right">
										<?= $form->field( $model , 'status' )->widget(
											\kartik\select2\Select2::className() ,
											[
												'data' =>
													[
														User::STATUS_DE_ACTIVE =>   \Yii::t('useradmin','مسدود')  ,
                                                        User::STATUS_ACTIVE    =>   \Yii::t('useradmin','فعال با قابلیت ورود')  ,

													] ,
												
												'pluginEvents' => [
													"change"              => "function() {  }" ,
													"select2:opening"     => "function() {  }" ,
													"select2:open"        => "function() {  }" ,
													"select2:closing"     => "function() {  }" ,
													"select2:close"       => "function() {  }" ,
													"select2:selecting"   => "function() {  }" ,
													"select2:select"      => "function() {  }" ,
													"select2:unselecting" => "function() {  }" ,
													"select2:unselect"    => "function() {  }"
												]
											]
										) ?>
										<div class="form-group">
											<button type="submit" class="btn btn-success"><?= \Yii::t('useradmin','ذخیره') ?></button>
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
	<div class="col-md-8">
		<div class="row" style="margin-top:20px">
			<div class="card card-nav-tabs">
				<div class="card-body ">
					<h4 class="text-center"></h4>
					<div class="row">
						<div class="col-md-6 pull-right">
							<?= $form->field( $model , 'nickName' )->textInput() ?>
						</div>
						<div class="col-md-6 pull-right">
							<?= $form->field( $model , 'email' )->textInput() ?>
						</div>
						<div class="col-md-6 pull-right">
							<?= $form->field( $model , 'password' )->textInput()->hint(
								  \Yii::t('useradmin','چنانچه خالی باشد، رمز عبور 123456 خواهد بود')
							) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php ActiveForm::end() ?>
