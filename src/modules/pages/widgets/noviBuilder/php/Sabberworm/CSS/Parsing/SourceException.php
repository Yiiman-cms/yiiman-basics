<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace Sabberworm\CSS\Parsing;

class SourceException extends \Exception
{
    private $iLineNo;

    public function __construct($sMessage, $iLineNo = 0)
    {
        $this->iLineNo = $iLineNo;
        if (!empty($iLineNo)) {
            $sMessage .= " [line no: $iLineNo]";
        }
        parent::__construct($sMessage);
    }

    public function getLineNo()
    {
        return $this->iLineNo;
    }
}