<?php
/**
 * Copyright (c) 2018-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib;

class BaseRuntimeException extends \RuntimeException
{
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }

    public function errorMessage()
    {
        return "\r\n".$this->getName()."[{$this->code}] : {$this->message}\r\n";
    }

    public function getName()
    {
        return 'BaseRuntimeException';
    }
}

?>

