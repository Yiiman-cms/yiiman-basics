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
 * Date: ۱۷/۰۴/۲۰۲۰
 * Time: ۰۳:۵۰ قبل‌ازظهر
 */

namespace YiiMan\YiiBasics\widgets\imageSelect;


use kartik\base\InputWidget;

class ImageSelectWidget extends InputWidget
{
    public $images = [];

    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub

        return $this->render('index', [
            'images' => $this->images,
            'name'   => $this->name,
            'value'  => $this->value
        ]);
    }
}
