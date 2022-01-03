<?php


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
