<?php
	/**
	 * Created by YiiMan TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:https://yiiman.ir
	 * Date: 12/29/2018
	 * Time: 4:51 PM
	 */
	$this->title='مدیریت فایل';
?>
<style>
	iframe {
		height: 70vh;
		width: 100%;
	}
</style>
<iframe src="<?= Yii::$app->urlManager->createUrl( ['/filemanager/default/iframe']) ?>" height="100" width="100" frameborder="0"></iframe>
