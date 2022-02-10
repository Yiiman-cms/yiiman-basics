<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/10/2022 AD 07:33
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs;

class TextInput extends BaseInputs
{

    public function __construct( $htmlAttributeName = null)
    {
        $this->htmlAttributeName = (string) $htmlAttributeName;
    }

    public static function JsExtendCode(): string
    {
        return <<<JS
$.extend({}, Input, {

    events: [
        ["blur", "onChange", "input"],
	 ],
	setValue: function(value) {
		$('input', this.element).val(value);
	},
	init: function(data) {
		return this.render("textinput", data);
	},
  }
)
JS;

    }


    public static function htmlTemplate(): string
    {
        return <<<HTML

        <div>
            <input name="{%=key%}" placeholder="{% if (typeof placeholder !== 'undefined' && placeholder != false) placeholder %}" value="{% if (typeof value !== 'undefined' && value != false) value %}" type="text" class="form-control"/>
        </div>
HTML;

    }
}