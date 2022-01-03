<?php
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: 03/22/2020
	 * Time: 22:27 PM
	 */
	
	namespace YiiMan\YiiBasics\widgets\topMenu;
	
	
	use YiiMan\YiiBasics\lib\View;
	use YiiMan\YiiBasics\widgets\TippyTooltip\TippyWidget;
	use Yii;
	use yii\base\Widget;
	use function is_int;
	use function is_string;
	
	class TopMenuWidget extends Widget {
		public function run() {
			return $this->render( 'index' );
		}
		
		public static function addBtb( $icon , $title = '' , $class = '' , $id = null , $link = null , $badge = '' , $flash = false ) {
			if ( ! empty( $id ) ) {
				$id = 'id="' . $id . '"';
			}
			if ( empty( $link ) ) {
				$link = '#';
			}
			if ( ! empty( $class ) ) {
				$class = 'btn-' . $class;
			}
			if ( ! empty( $title ) ) {
				$tippy = TippyWidget::attribute( $title );
			} else {
				$tippy = '';
			}
			if (!empty( $badge)){
				if (is_int( $badge)){
					$badge='<span class="notification">'.$badge.'</span>';
				}elseif (is_string( $badge)){
					$badge='<span class="notification"><i class="material-icons">'.$badge.'</i></span>';
				}else{
					$badge='';
				}
			}
			if ($flash){
				$flash='flash';
			}else{
				$flash ='';
			}
			$js = <<<JS
 			$('.top-menu-container .button-container').append('<a class="item $flash btn $class btn-round" $id href="$link" $tippy>$badge<i class="material-icons">$icon</i></a>');

JS;
			Yii::$app->controller->view->registerJs( $js , View::POS_END );
		}
	}
