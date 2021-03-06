<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\summernote;


use kartik\base\InputWidget;
use YiiMan\YiiBasics\lib\View;
use YiiMan\YiiBasics\widgets\summernote;

class SummernoteWidget extends InputWidget
{
    public function run()
    {
        $js = <<<JS
$(document).ready(function() {
        $('#{$this->id}').summernote();
    });
JS;
        SummernoteAssets::register($this->view);
        $this->view->registerJs($js, View::POS_END);

        return '<div id="'.$this->id.'">'.$this->value.'</div>';
    }
}
