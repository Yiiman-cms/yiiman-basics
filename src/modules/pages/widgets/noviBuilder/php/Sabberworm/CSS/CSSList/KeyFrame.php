<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace Sabberworm\CSS\CSSList;

use Sabberworm\CSS\Property\AtRule;

class KeyFrame extends CSSList implements AtRule
{

    private $vendorKeyFrame;
    private $animationName;

    public function __construct($iLineNo = 0)
    {
        parent::__construct($iLineNo);
        $this->vendorKeyFrame = null;
        $this->animationName = null;
    }

    public function getVendorKeyFrame()
    {
        return $this->vendorKeyFrame;
    }

    public function setVendorKeyFrame($vendorKeyFrame)
    {
        $this->vendorKeyFrame = $vendorKeyFrame;
    }

    public function getAnimationName()
    {
        return $this->animationName;
    }

    public function setAnimationName($animationName)
    {
        $this->animationName = $animationName;
    }

    public function __toString()
    {
        return $this->render(new \Sabberworm\CSS\OutputFormat());
    }

    public function render(\Sabberworm\CSS\OutputFormat $oOutputFormat)
    {
        $sResult = "@{$this->vendorKeyFrame} {$this->animationName}{$oOutputFormat->spaceBeforeOpeningBrace()}{";
        $sResult .= parent::render($oOutputFormat);
        $sResult .= '}';
        return $sResult;
    }

    public function isRootList()
    {
        return false;
    }

    public function atRuleName()
    {
        return $this->vendorKeyFrame;
    }

    public function atRuleArgs()
    {
        return $this->animationName;
    }
}
