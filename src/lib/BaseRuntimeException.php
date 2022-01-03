<?php
/**
 * Copyright (c) 2018.
 * Author: YiiMan Tm
 * Programmer: gholamreza beheshtian
 * mobile: 09353466620
 * WebSite:https://yiiman.ir
 *
 *
 */

namespace YiiMan\YiiBasics\lib;

class BaseRuntimeException extends \RuntimeException 
{
	public function getName()
    {
        return 'BaseRuntimeException';
    }
    public function __construct($message, $code=0) {
        parent::__construct($message, $code);
    }
	public function errorMessage(){
		return "\r\n".$this->getName() . "[{$this->code}] : {$this->message}\r\n";
	}
}

?>

