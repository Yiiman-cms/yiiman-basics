<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/10/2022 AD 10:07
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs;

/**
 * @property int $min
 * @property int $max
 * @property int $step
 * @property bool $inline
 */
class RangeInput extends BaseInputs
{

    public int $min;
    public int $max;
    public int $step;
    public bool $inline;

    public function __construct(
        string $htmlAttributeName,
        int $min = 1,
        int $max = 100,
        int $step = 1,
        bool $inline = true
    ) {
        $this->htmlAttributeName = $htmlAttributeName;
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
        $this->inline = $inline;
    }

    public static function JsExtendCode(): string
    {
        return <<<JS
$.extend({}, Input, {

    events: [
        ["change", "onChange", "input"],
	 ],
	
	init: function(data) {
		return this.render("rangeinput", data);
	},
  }
)
JS;

    }

    public static function htmlTemplate(): string
    {
        return <<<HTML
        <div>
            <input name="{%=key%}" type="range" min="{%=min%}" max="{%=max%}" step="{%=step%}" class="form-control"/>
        </div>
HTML;

    }
}