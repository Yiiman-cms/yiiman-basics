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

?>

<div class="image-collection" id="image-collection<?= $id ?>">
	<?php
		foreach ( $images as $thump=> $image ) {
		    $uniq=uniqid();
			?>
            <label for="<?= $uniq ?>">
                <input id="<?= $uniq ?>" type="radio" name="<?= $name ?>" value="<?= $thump ?>"  <?= $thump==$value?'checked':'' ?> >
                <img class="imgselect" name="<?= $name ?>" value="<?= $thump ?>" src="<?= $image ?>" origin="<?= $image ?>" alt="">
            </label>
			<?php
		}
	?>
</div>
