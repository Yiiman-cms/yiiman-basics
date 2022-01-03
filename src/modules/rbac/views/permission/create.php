<?php
	
	use yii\helpers\Html;
	
	
	/* @var $this yii\web\View */
	/* @var $model \YiiMan\YiiBasics\modules\rbac\models\AuthItem */
	$this->title = Yii::t( 'rbac' , 'create new permission' );
?>
<div class="auth-item-create">
	<?= $this->render(
		'_form' ,
		[
			'model' => $model ,
		]
	) ?>
</div>
