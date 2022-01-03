<?php

/**
 * Copyright (c) 2014-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\multiRowInput\renderers;


/**
 * Interface RendererInterface
 * @package YiiMan\YiiBasics\widgets\multiRowInput\renderers
 */
interface RendererInterface
{
    const POS_HEADER = 'header';
    const POS_ROW = 'row';
    const POS_ROW_BEGIN = 'row_begin';
    const POS_FOOTER = 'footer';

    const THEME_DEFAULT = 'default';
    const THEME_BS = 'bootstrap';

    /**
     * Renders the widget's content.
     * @return mixed
     */
    public function render();

    /**
     * Set current context.
     * @param  mixed  $context
     * @return mixed
     */
    public function setContext($context);

    /**
     * Returns a placeholder.
     * @return string
     */
    public function getIndexPlaceholder();
}
