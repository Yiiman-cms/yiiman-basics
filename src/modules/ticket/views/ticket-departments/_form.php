<?php
use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\ticket\models\TicketDepartments */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="ticket-departments-form">

    <?php $form = ActiveForm::begin(); ?>

    
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="card card-nav-tabs">
                        <div class="card-body ">
                            <h4 class="text-center">وضعیت
                                انتشار دپارتمان</h4>

                            <div class="row">
                                <div class="col-md-12 pull-right">
                                    <?= $form->field( $model , 'status' )->widget(
											\kartik\select2\Select2::className() ,
											[
												'data'          =>
													[
														$model::STATUS_ACTIVE  => 'منتشر شده' ,
														$model::STATUS_DE_ACTIVE   => 'در حال بازبینی' ,
														
													] ,
												'options'       => [ 'dir' => 'rtl' ] ,
												'pluginOptions' => [ 'dir' => 'rtl' ] ,
												'pluginEvents'  => [
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
                                        <button type="submit" class="btn btn-success">ذخیره</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                            </div>
            <div class="col-md-9">
                <div class="card card-nav-tabs card-rtl">
                    <div class="card-body ">
                        <div class="col-md-12">
                            <h4 class="text-center">مشخصات</h4>
                            <div class="row">
                                    <div class="col-md-6"><?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        

    <?php ActiveForm::end(); ?>

</div>
