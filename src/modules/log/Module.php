<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\log;

/**
 * tour module definition class
 */


use Yii;
use yii\helpers\ArrayHelper;

class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace;
    public $name;
    public $nameSpace;
    public $config = [];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        // < set Class Parameters >
        {
            $this->config = include realpath(__DIR__.'/config.php');
            $this->nameSpace = 'YiiMan\YiiBasics\modules\\'.$this->config['name'];
            $this->controllerNamespace = 'YiiMan\YiiBasics\modules\\'.$this->config['name'].'\controllers';
            $this->name = $this->config['name'];

        }
        // </ set Class Parameters >


    }

}
