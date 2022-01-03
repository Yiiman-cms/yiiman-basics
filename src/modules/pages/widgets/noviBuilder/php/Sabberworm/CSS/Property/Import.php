<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace Sabberworm\CSS\Property;

use Sabberworm\CSS\Value\URL;

/**
 * Class representing an @import rule.
 */
class Import implements AtRule
{
    protected $iLineNo;
    protected $aComments;
    private $oLocation;
    private $sMediaQuery;

    public function __construct(URL $oLocation, $sMediaQuery, $iLineNo = 0)
    {
        $this->oLocation = $oLocation;
        $this->sMediaQuery = $sMediaQuery;
        $this->iLineNo = $iLineNo;
        $this->aComments = [];
    }

    /**
     * @return int
     */
    public function getLineNo()
    {
        return $this->iLineNo;
    }

    public function setLocation($oLocation)
    {
        $this->oLocation = $oLocation;
    }

    public function getLocation()
    {
        return $this->oLocation;
    }

    public function __toString()
    {
        return $this->render(new \Sabberworm\CSS\OutputFormat());
    }

    public function render(\Sabberworm\CSS\OutputFormat $oOutputFormat)
    {
        return "@import ".$this->oLocation->render($oOutputFormat).($this->sMediaQuery === null ? '' : ' '.$this->sMediaQuery).';';
    }

    public function atRuleName()
    {
        return 'import';
    }

    public function atRuleArgs()
    {
        $aResult = [$this->oLocation];
        if ($this->sMediaQuery) {
            array_push($aResult, $this->sMediaQuery);
        }
        return $aResult;
    }

    public function addComments(array $aComments)
    {
        $this->aComments = array_merge($this->aComments, $aComments);
    }

    public function getComments()
    {
        return $this->aComments;
    }

    public function setComments(array $aComments)
    {
        $this->aComments = $aComments;
    }
}