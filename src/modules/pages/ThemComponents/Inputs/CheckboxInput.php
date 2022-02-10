<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/10/2022 AD 07:40
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs;


class CheckboxInput extends BaseInputs
{


    public function __construct($htmlAttributeName)
    {
        $this->htmlAttributeName=$htmlAttributeName;
    }

    public static function JsExtendCode(): string
    {
        return <<<JS
$.extend({}, Input, {

	onChange: function(event, node) {
		
		if (event.data && event.data.element)
		{
			event.data.element.trigger('propertyChange', [this.checked, this]);
		}
	},

    events: [
        ["change", "onChange", "input"],
	 ],
	
	init: function(data) {
		return this.render("checkboxinput", data);
	},
  }
)
JS;

    }

    public static function htmlTemplate(): string
    {
       return <<<HTML
 <div class="custom-control custom-checkbox">
            <input name="{%=key%}" class="custom-control-input" type="checkbox" id="{%=key%}_check">
            <label class="custom-control-label" for="{%=key%}_check">{% if (typeof text !== 'undefined') { %} {%=text%}
                {% } %}</label>
        </div>
HTML;

    }
}