<?php
use YiiMan\YiiBasics\modules\filemanager\widget\FileSelectorWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model YiiMan\YiiBasics\modules\slug\models\Slug */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slug-form">
	
	<?php $form = ActiveForm::begin(); ?>
	
	    <div class="col-md-6"><?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-6"><?= $form->field($model, 'table_name')->textInput(['maxlength' => true]) ?></div>

    <div class="col-md-6"><?= $form->field($model, 'table_id')->textInput() ?></div>

	
	
	<?php ActiveForm::end(); ?>

</div>
