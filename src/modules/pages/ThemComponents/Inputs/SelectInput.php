<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/10/2022 AD 07:45
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs;

use YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs\Data\OptionData;

/**
 * @property OptionData[] $data
 * @property array        $validValues
 */
class SelectInput extends BaseInputs
{
    public array $data;
    public array $validValues;

    /**
     * @param  OptionData[]  $options
     */
    public function __construct(array $options,array $validValues = [],string $htmlAttributeName = '')
    {
        $this->data = $options;
        $this->validValues = $validValues;
        $this->htmlAttributeName =(string) $htmlAttributeName;
    }

    public function generateOptions(){
        $array=[];
        foreach ($this->data as $item){
            $array[]=['value'=>$item->value,'text'=>$item->text];
        }

        return json_encode($array);
    }

    public static function JsExtendCode(): string
    {
        return <<<JS
$.extend({}, Input, {
	
    events: [
        ["change", "onChange", "select"],
	 ],
	

	setValue: function(value) {
		$('select', this.element).val(value);
	},
	
	init: function(data) {
		return this.render("select", data);
	},
	
  }
)
JS;

    }

    public static function htmlTemplate(): string
    {
        return <<<HTML
        <div>

            <select class="form-control custom-select">
                {% for ( var i = 0; i < options.length; i++ ) { %}
                <option value="{%=options[i].value%}">{%=options[i].text%}</option>
                {% } %}
            </select>

        </div>
HTML;

    }
}