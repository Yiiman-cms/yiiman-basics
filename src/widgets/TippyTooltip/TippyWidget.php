<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: 03/22/2020
 * Time: 23:47 PM
 */

namespace YiiMan\YiiBasics\widgets\TippyTooltip;


use YiiMan\YiiBasics\widgets\TippyTooltip\assets\TippyAsset;
use yii\base\Widget;

class TippyWidget extends Widget
{

    public static function attribute($title)
    {
        return 'data-toggle="tooltip" data-tippy-content="'.$title.'"';
    }

    public function run()
    {
        $js = <<<JS
 			tippy('[data-toggle="tooltip"]');
JS;
        TippyAsset::register($this->view);
        $this->view->registerJs($js, $this->view::POS_END);
    }
}
