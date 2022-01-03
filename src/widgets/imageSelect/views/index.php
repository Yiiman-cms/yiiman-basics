<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

	/**
	 * Created by YiiMan.
	 * Programmer: gholamreza beheshtian
	 * Mobile:+989353466620 | +17272282283
	 *
	 * Site:https://yiiman.ir
	 * Date: ۱۷/۰۴/۲۰۲۰
	 * Time: ۰۳:۵۲ قبل‌ازظهر
	 */
	
	/**
	 * @var $this   \YiiMan\YiiBasics\lib\View
	 * @var $images []
	 */
	
	use YiiMan\YiiBasics\widgets\imageSelect\ImageSelectAsset;
	
	ImageSelectAsset::register( $this );
	$js = <<<Js
$(".imgselect").imgCheckbox({radio:true,addToForm:true});
Js;
	$this->registerJs( $js , $this::POS_END );
?>
<style>
	.image-collection {
		display: flex;
		width: 100%;
		overflow: auto;
		flex-wrap: nowrap;
		/* flex-flow: row wrap; */
		overflow: auto;
	}
	.imgCheckbox0 {

		order: 5;
		flex-grow: 5;
	}
	span.imgCheckbox0 {
		
		user-select: none;
		position: relative;
		padding: 0px;
		margin: 5px;
		display: inline-block;
		border: 1px solid transparent;
		transition-duration: 300ms;
		
	}
	.imgCheckbox0 {
		
		float: right;
		width: 340px !important;
		order: 3;
		margin: 2px !important;
		flex-grow: 0;
		
	}
	.image-collection span {
		padding: 0;
		width: 100%;
		height: auto;
	}
	.image-collection img {
		width: auto;
		height: 225px;
		margin: auto !important;
		display: block !important;
		border-radius: 5px;
		box-shadow: rgba(0, 0, 0, 0.14) 0px 2px 2px 0px, rgba(0, 0, 0, 0.2) 0px 3px 1px -2px, rgba(0, 0, 0, 0.12) 0px 1px 5px 0px;
	}
	
</style>
<div class="image-collection">
	<?php
		foreach ( $images as $thump=> $image ) {
		    $selected='';
		    if ($value==$image){
		        $selected='imgChked';
            }
			?>
			<img class="imgselect <?= $selected ?>" name="<?= $name ?>" value="<?= $image ?>" src="<?= $thump ?>" origin="<?= $image ?>" alt="" >
			<?php
		}
	?>
</div>
