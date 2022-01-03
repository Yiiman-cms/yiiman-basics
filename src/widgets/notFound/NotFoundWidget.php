<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\notFound;

use yii\base\Widget;

/**
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: 01/05/2019
 * Time: 07:00 PM
 */
class NotFoundWidget extends Widget
{
    public $text;
    public $withRowColumn = true;

    public function run()
    {

        return $this->render(
            'index',
            [
                'text'          => $this->text,
                'withRowColumn' => $this->withRowColumn,
            ]
        );
    }
}
