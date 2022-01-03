<?php
	
	use yii\helpers\Html;
	
	/* @var $this yii\web\View */
	/* @var $model YiiMan\YiiBasics\modules\useradmin\models\User */
	
	$this->title                   = Yii::t(
		'useradmin' ,
		'کاربر {nameAttribute} '  ,
		[
			'nameAttribute' =>  $model->email ,
		]
	);
	$this->params['breadcrumbs'][] = [ 'label' => Yii::t( 'useradmin' , 'کاربران ادمین' ) , 'url' => [ 'index' ] ];
	$this->params['breadcrumbs'][] = [ 'label' => $model->email , 'url' => [ 'view' , 'id' => $model->id ] ];
	$this->params['breadcrumbs'][] = Yii::t( 'useradmin' , 'ویرایش' );
?>
<div class="user-update">

	<?= $this->render(
		'_form' ,
		[
			'model' => $model
		]
	) ?>

</div>
