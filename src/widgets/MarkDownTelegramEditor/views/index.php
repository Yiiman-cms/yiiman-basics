<?php
	/**
	 * Copyright (c) 2018.
	 * Author: Tokapps Tm
	 * Programmer: gholamreza beheshtian
	 * mobile: 09353466620
	 * WebSite:http://tokapps.ir
	 *
	 *
	 */
	
	//	https://github.com/Ionaru/easy-markdown-editor
	use rmrevin\yii\fontawesome\FontAwesome;
	use YiiMan\YiiBasics\widgets\MarkDownTelegramEditor\assets\MarkDownTelegramEditorAssets;
	
	use yii\helpers\Html;
	use yii\web\View;
	
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: 8/16/2018
	 * Time: 2:59 AM
	 */
	/**
	 * @var $model              \yii\db\ActiveRecord
	 * @var $this               \yii\web\View
	 * @var $cls                \yii\widgets\InputWidget
	 * @var $hashModel          boolean
	 * @var $is_in_ajax_modal   boolean
	 */
	
	MarkDownTelegramEditorAssets::register( $cls->view );
	

	$js = <<<JS
    var mde;
	$(document).ready(function() {
			
					  mde=new EasyMDE({
					            autoDownloadFontAwesome: true,
					            toolbar:
					            [
							            'bold',
							            'fullscreen',
							            'side-by-side',
							            'preview',
							            'link',
							            'italic',
							            'code'
					            ],
					            
					            element: document.getElementById('$id'),
					            
					            blockStyles: {
									bold: "*",
									italic: "_",
								},
								shortcuts: {
									drawTable: "Cmd-Alt-T"
								},
								showIcons: ["code", "bold","italic"],
				     });
					 console.log(mde);
			});
JS;
	
		$this->registerJs( $js , View::POS_END );
	
	
	if ( $hashModel ) {
		echo Html::activeTextarea(
			$cls->model ,
			$cls->attribute ,
			[ 'margin-top' => '20px' , 'margin-bottom' => '20px' , 'id' => $cls->id ]
		);
		
	} else {
		echo Html::textarea(
			$cls->name ,
			$cls->value ,
			[ 'margin-top' => '20px' , 'margin-bottom' => '20px' , 'id' => $cls->id ]
		);
		
	}
	if ($is_in_ajax_modal){
		?>
		<script><?= $js ?></script>
<?php
	}
?>
<style>
	.CodeMirror.cm-s-easymde.CodeMirror-wrap {
		text-align: right;
		direction: rtl;
		padding-right: 29px;
	}
</style>
