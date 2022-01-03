<?php
/**
 * Copyright (c) 2018-2022.
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
 * Date: 8/16/2018
 * Time: 2:57 AM
 */

namespace YiiMan\YiiBasics\widgets\MarkDownTelegramEditor;


use yii\base\Widget;
use yii\widgets\InputWidget;

class MarkDownTelegramEditorWidget extends InputWidget
{

    public $value;
    public $is_in_ajax_modal = false;

    public function run()
    {


        if (empty($this->value)) {
            if (!empty($this->model->{$this->attribute})) {
                $this->value = $this->model->{$this->attribute};
            } else {
                $this->value = '';
            }
        }


        echo $this->render(
            'index',
            [
                'model'            => $this->model,
                'id'               => $this->id,
                'name'             => $this->name,
                'value'            => $this->value,
                'cls'              => $this,
                'hashModel'        => $this->hasModel(),
                'is_in_ajax_modal' => $this->is_in_ajax_modal,
            ]
        );
    }
}
