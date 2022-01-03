<?php
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: 03/22/2020
	 * Time: 22:30 PM
	 */
	
	/**
	 * @var $this \YiiMan\YiiBasics\lib\View
	 */
	
	use YiiMan\YiiBasics\widgets\TippyTooltip\TippyWidget;
	
	TippyWidget::widget();
	
?>
<style>
	.top-menu-container .button-container {
		position: relative;
		margin-top: -70px;
		width: 50%;
		left: 0;
		margin-bottom: 0;
		height: 60px;
		right: auto;
		float: left;
		background: linear-gradient(90deg, hsla(240, 19.4%, 26.3%, 0.45) 0%, hsla(241.5, 91.1%, 8.8%, 0) 100%);
		border-radius: 5px 100px 100px 5px;
	}
	
	.top-menu-container .button-container .item {
		float: left;
		margin-top: 9px;
		margin-left: 10px;
		margin-bottom: 0;
		width: 40px;
		height: 40px;
		padding-top: 11px;
		padding-bottom: 0;
		padding-left: 0;
		padding-right: 0;
		background: white;
	}
	
	.btn .material-icons, .btn:not(.btn-just-icon):not(.btn-fab) .fa {
		position: relative;
		display: inline-block;
		top: 0;
		margin-top: -1em;
		margin-bottom: -1em;
		vertical-align: middle;
		color: hsl(0, 1.6%, 49.4%);
		font-size: large;
		transition: 0.5s ease;
	}
	
	.top-menu-container .button-container .item i:hover {
		color: hsla(278.4, 88%, 35.9%, 0.84);
		transition: 0.5s ease;
	}
	
	.top-menu-container .button-container .item:hover ~ .top-menu-container .button-container .item i {
		color: hsla(278.4, 88%, 35.9%, 0.84) !important;
		transition: 0.5s ease;
	}
	.top-menu-container .button-container .item.btn-success {
		background: hsl(120, 100%, 30.8%);
	}
	.top-menu-container .button-container .item.btn-danger {
		background: hsl(3, 100%, 31%);
	}
	
	.top-menu-container .button-container .item.btn-success i,.top-menu-container .button-container .item.btn-danger i{
		color: white;
	}
	
</style>
<div class="top-menu-container">
	<?php if ( isset( $this->blocks['content-header'] ) ) { ?>
		<h2 class="page-title"><?= $this->blocks['content-header'] ?></h2>
		<?php
	} else {
		?>
		<h2 class="page-title">
			<?php
				if ( $this->title !== null ) {
					echo \yii\helpers\Html::encode( $this->title );
				} else {
					echo \yii\helpers\Inflector::camel2words(
						\yii\helpers\Inflector::id2camel( $this->context->module->id )
					);
					echo ( $this->context->module->id !== \Yii::$app->id ) ? '  <small>Module</small>' : '';
				}
			?>
		</h2>
	<?php } ?>
	<div class="button-container">

	</div>
</div>

