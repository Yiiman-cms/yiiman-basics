<?php
	
	use yii\helpers\Html;
	
	
	/* @var $this yii\web\View */
	/* @var $model YiiMan\YiiBasics\modules\useradmin\models\User */
	
	$this->title                   = Yii::t( 'useradmin' , 'افزودن کاربر جدید' );
	$this->params['breadcrumbs'][] = [ 'label' => Yii::t( 'useradmin' , 'کاربران ادمین' ) , 'url' => [ 'index' ] ];
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

	<?= $this->render(
		'_form' ,
		[
			'model' => $model
		]
	) ?>

</div>
