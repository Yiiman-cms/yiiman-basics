<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace Sabberworm\CSS\Parsing;

/**
 * Thrown if the CSS parsers attempts to print something invalid
 */
class OutputException extends SourceException
{
    public function __construct($sMessage, $iLineNo = 0)
    {
        parent::__construct($sMessage, $iLineNo);
    }
}