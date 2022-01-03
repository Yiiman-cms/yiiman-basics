<?php
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
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
