<?php
	/**
	 * Created by YiiMan TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:https://yiiman.ir
	 * Date: 12/15/2018
	 * Time: 1:23 AM
	 */
	
	use YiiMan\YiiBasics\modules\setting\widgets\FieldRender;

?>

<div class="card" style="margin-top: 20px">
	<h3>تنظیمات صفحه ی خطا</h3>
	<?php
		$themeFolders = getFileList( __DIR__ . '/../themes' );
		$themes       = [];
		/* < Check if Asset Folder Is Not Exist > */
		{
			if ( ! realpath( Yii::$app->basePath . '/assets/error-themes/' ) ) {
				mkdir( Yii::$app->basePath . '/assets/error-themes/' );
			}
		}
		/* </ Check if Asset Folder Is Not Exist > */
		foreach ( $themeFolders as $theme ) {
			$item = [];
			if ( ! realpath( Yii::$app->basePath . '/assets/error-themes/' . $theme['name'] . 'scr.jpg' ) ) {
				copy(
					realpath( __DIR__ . '/../themes/' . $theme['name'] . '/screenshot.jpg' ) ,
					Yii::$app->basePath . '/assets/error-themes/' . $theme['name'] . '-scr.jpg'
				);
			}
			Yii::$app->urlManager->showScriptName=false;
			$item['img']   = Yii::$app->homeUrl . '/assets/error-themes/' . $theme['name'] . '-scr.jpg';
			$item['value'] = $theme['name'];
			$themes[]      = $item;
		}
		
		
		echo
		\YiiMan\YiiBasics\modules\setting\widgets\FieldRender::FieldsRender(
			[
				
				[
					'name'  => 'errorTheme' ,
					'label' => 'انتخاب قالب صفحات خطا' ,
					'type'  => FieldRender::TYPE_RADIO_BUTTON_IMAGE ,
					'hint'  => 'با انتخاب هر یک از قالب های موجود، از این پس خطاهای سیستمی با طرح انتخابی شما به کاربر نمایش داده خواهد شد.' ,
					'items' => $themes
				]
			]
			
		)
	?>
</div>
