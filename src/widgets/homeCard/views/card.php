<?php
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: 8/20/2018
	 * Time: 12:32 PM
	 */
	
	/**
	 * @var $home \common\models\Homes
	 */
?>

<div class="article  col-lg-3 col-sm-6 col-12">
	<a href="<?= Yii::$app->urlManager->createUrl( [ '/home/' . $home->hash ] ) ?>" class="article-details">
		<div class="article-image"
		     style="background-image: url('/assets/images/img1.png');">
			<div class="details">
				<div>
					<span class="article-addr"><?= $home->neighbourhood ?></span>
					<h2 class="article-title"><?= $home->priceTitrText().' '.$home->size_of_land . ' ' . 'متر' ?></h2>
				</div>
			</div>
		</div>
		<div class="article-footer">
			<?= $home->footerPrice() ?>
		</div>
	</a>
</div>
