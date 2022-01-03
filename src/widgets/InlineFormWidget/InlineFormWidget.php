<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\InlineFormWidget;


use yii\bootstrap\Widget;

class InlineFormWidget extends Widget
{
    public $action;
    public $template = [];
    public $items = [];
    private $Default_template =
        [
            'input'    => '
            <div class="form-group">
                <label for="{id}">{label}</label>
                <input type="email" class="form-control" id="{id}" name="{name}" {attr} placeholder="{placeholder}">
                <small id="{id}" class="form-text text-muted">{hint}</small>
            </div>
            ',
            'button'   => '<button type="{type}" {attr} class="btn btn-{color}">{label}</button>',
            'textarea' =>
                '
            <div class="form-group">
                <label for="{id}">{label}</label>
                <textarea class="form-control" name="{name}" {attr} id="{id}" rows="3"></textarea>
            </div>
            ',
            '
            
            '
        ];

    public function run()
    {

    }
}
