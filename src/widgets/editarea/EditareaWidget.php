<?php


namespace YiiMan\YiiBasics\widgets\editarea;


use kartik\base\InputWidget;
use YiiMan\YiiBasics\lib\View;
use YiiMan\YiiBasics\widgets\summernote\SummernoteAssets;
use yii\helpers\Html;

class EditareaWidget extends InputWidget
{

    public function run()
    {
        $js = <<<JS
$(document).ready(function() {
       editAreaLoader.init({
	id : "{$this->id}"		// textarea id
	,syntax: "html"			// syntax to be uses for highgliting
	,start_highlight: true		// to display with highlight mode on start-up
});
    });
JS;
        EditareaAssets::register($this->view);
        $this->view->registerJs($js, View::POS_END);
        $this->view->registerCss('iframe {
	width: 100% !important;
}');

        return Html::textarea($this->name, $this->value, ['id' => $this->id,'rows'=>15,'cols'=>30]);
    }
}
