<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace Sabberworm\CSS;

interface Renderable
{
    public function __toString();

    public function render(\Sabberworm\CSS\OutputFormat $oOutputFormat);

    public function getLineNo();
}