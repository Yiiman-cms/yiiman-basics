<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/10/2022 AD 07:38
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs;

class TextareaInput extends BaseInputs
{

    public static function JsExtendCode(): string
    {
        return <<<JS
$.extend({}, Input, {

    events: [
        ["keyup", "onChange", "textarea"],
	 ],
	
	setValue: function(value) {
		$('textarea', this.element).val(value);
	},
	
	init: function(data) {
		return this.render("textareainput", data);
	},
  }
)
JS;

    }

    public static function htmlTemplate(): string
    {
       return <<<HTML
        <div>
            <textarea name="{%=key%}" rows="3" class="form-control">{% if (typeof text !== 'undefined' && text != false) text %}</textarea>
        </div>
HTML;

    }
}