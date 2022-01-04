<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\ticket\widgets;


use YiiMan\YiiBasics\modules\ticket\models\Ticket;
use yii\bootstrap\Widget;

/**
 * Class MessengerWidget
 * @package YiiMan\YiiBasics\modules\ticket\widgets
 * @property Ticket $model
 */
class MessengerWidget extends Widget
{
    public $model;

    public function run()
    {
        return $this->render('index', ['model' => $this->model]);
    }


}
