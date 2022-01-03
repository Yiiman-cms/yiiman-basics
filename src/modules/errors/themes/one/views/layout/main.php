<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

	/**
	 * Created by YiiMan TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:+989353466620 | +17272282283
	 *
	 * Site:https://yiiman.ir
	 * Date: 12/14/2018
	 * Time: 8:14 PM
	 */
	
	use backend\assets\AppAsset;
	use YiiMan\YiiBasics\modules\errors\themes\one\assets\ErrorAsset;
	
	/**
	 * @var $this \yii\web\View
	 */
	$assets=ErrorAsset::register( $this);
	$this->beginPage();
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" >



<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<title><?= $this->title ?></title>
	<?= \yii\helpers\Html::csrfMetaTags() ?>
	<?= $this->head() ?>

</head>



<body class="bg-purple" style="background-image: url(<?= $assets->baseUrl ?>/imag/bg_purple.png)">
<?php
	$this->beginBody();
?>
<div class="stars">
	
	<div class="central-body">
		<?= $content ?>
		<a href="<?= Yii::$app->homeUrl ?>" class="btn-go-home" target="_blank">بازگشت</a>
	</div>
	<div class="objects">
		<img class="object_rocket" src="<?= $assets->baseUrl ?>/imag/rocket.svg" width="40px">
		<div class="earth-moon">
			<img class="object_earth" src="<?= $assets->baseUrl ?>/imag/earth.svg" width="100px">
			<img class="object_moon" src="<?= $assets->baseUrl ?>/imag/moon.svg" width="80px">
		</div>
		<div class="box_astronaut">
			<img class="object_astronaut" src="<?= $assets->baseUrl ?>/imag/man.svg" width="140px">
		</div>
	</div>
	<div class="glowing_stars">
		<div class="star"></div>
		<div class="star"></div>
		<div class="star"></div>
		<div class="star"></div>
		<div class="star"></div>
	
	</div>

</div>
<?php
	$this->endBody();
?>
</body>





<!-- Mirrored from yasanweb.com/demo/404/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Dec 2018 17:47:45 GMT -->
</html>
<?php
$this->endPage();
?>
