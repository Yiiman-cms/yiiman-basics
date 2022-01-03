<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace Sabberworm\CSS\Value;

abstract class PrimitiveValue extends Value
{
    public function __construct($iLineNo = 0)
    {
        parent::__construct($iLineNo);
    }

}