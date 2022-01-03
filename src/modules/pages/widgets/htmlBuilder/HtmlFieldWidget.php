<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: ۰۲/۲۴/۲۰۲۰
 * Time: ۱۱:۵۳ قبل‌ازظهر
 */

namespace YiiMan\YiiBasics\modules\pages\widgets\htmlBuilder;


use kartik\base\InputWidget;

class HtmlFieldWidget extends InputWidget
{

    public function run()
    {
        parent::run();

        return $this->render(
            'htmlField',
            [
                'value' => $this->value,
                'id'    => $this->id,
                'model' => $this->model
            ]
        );
    }
}
