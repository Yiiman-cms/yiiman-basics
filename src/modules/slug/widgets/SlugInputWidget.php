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
 * Date: ۰۲/۲۲/۲۰۲۰
 * Time: ۱۶:۴۰ بعدازظهر
 */

namespace YiiMan\YiiBasics\modules\slug\widgets;


use kartik\base\InputWidget;

class SlugInputWidget extends InputWidget
{
    public $origModel;

    public function run()
    {
        parent::run();

        return $this->render(
            'field.php',
            [
                'id'        => $this->id,
                'name'      => $this->name,
                'value'     => $this->value,
                'options'   => $this->options,
                'model'     => $this->model,
                'label'     => $this->model,
                'origModel' => $this->origModel,
            ]
        );
    }
}
