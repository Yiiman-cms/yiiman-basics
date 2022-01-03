<?php
	
	namespace YiiMan\YiiBasics\widgets\toggle;
	
	use Yii;
	use yii\base\Widget;
	use yii\helpers\Html;
	use yii\widgets\InputWidget;
	
	/**
	 * Class ToggleWidget
	 * @package YiiMan\YiiBasics\widgets\toggle
	 * @property \YiiMan\YiiBasics\lib\View $view
	 */
	class ToggleWidget extends \kartik\base\InputWidget {
		public $model;
		public $attribute;
		public $view;
		public $className;
		public $label;
		public $description;
		public $for;
		
		public function init() {
			
			parent::init();
			if ( ! empty( $_POST ) && empty( $_POST['DynamicModel'][ $this->attribute ] ) ) {
				Yii::$app->Options->set( $this->attribute , '' );
			}
			
			$this->for = $this->hasModel() ? Html::getInputId( $this->model , $this->attribute ) : $this->getId();
			$css=<<<CSS

.togglebutton label {
	cursor: pointer;
	color: hsla(0, 5.9%, 3.3%, 0.67) !important;
	width: 65px !important;
	/* margin: 0; */
	/* padding: 0; */
	margin-top: 6px !important;
	height: 27px;
	border: solid 1px hsla(0, 0%, 0%, 0.06);
	padding: 7px 0 !important;
	border-radius: 5px;
	/* padding-right: 0px; */
	float: none;
}
CSS;

			$this->view->registerCss($css);
			echo $this->render
			(
				'toggle' ,
				[
					'name'        => $this->name ,
					'label'       => $this->label ,
					'description' => $this->description ,
					'value'       => $this->value ,
					'id'          => $this->id ,
					'for'         => $this->for
				]
			);
		}
	}
