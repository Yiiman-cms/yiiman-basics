<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace Sabberworm\CSS\Value;

abstract class ValueList extends Value
{

    protected $aComponents;
    protected $sSeparator;

    public function __construct($aComponents = [], $sSeparator = ',', $iLineNo = 0)
    {
        parent::__construct($iLineNo);
        if (!is_array($aComponents)) {
            $aComponents = [$aComponents];
        }
        $this->aComponents = $aComponents;
        $this->sSeparator = $sSeparator;
    }

    public function addListComponent($mComponent)
    {
        $this->aComponents[] = $mComponent;
    }

    public function getListComponents()
    {
        return $this->aComponents;
    }

    public function setListComponents($aComponents)
    {
        $this->aComponents = $aComponents;
    }

    public function getListSeparator()
    {
        return $this->sSeparator;
    }

    public function setListSeparator($sSeparator)
    {
        $this->sSeparator = $sSeparator;
    }

    public function __toString()
    {
        return $this->render(new \Sabberworm\CSS\OutputFormat());
    }

    public function render(\Sabberworm\CSS\OutputFormat $oOutputFormat)
    {
        return $oOutputFormat->implode($oOutputFormat->spaceBeforeListArgumentSeparator($this->sSeparator).$this->sSeparator.$oOutputFormat->spaceAfterListArgumentSeparator($this->sSeparator),
            $this->aComponents);
    }

}
