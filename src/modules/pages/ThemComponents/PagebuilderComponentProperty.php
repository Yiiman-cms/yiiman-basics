<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/10/2022 AD 06:24
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents;

use YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs\CheckboxInput;
use YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs\ImageInput;
use YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs\LinkInput;
use YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs\RangeInput;
use YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs\SelectInput;
use YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs\TextareaInput;
use YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs\TextInput;

/**
 * @property string     $title
 * @property string     $key
 * @property BaseInputs $inputClass
 * @property string     $onChangeJS
 */
class PagebuilderComponentProperty
{
    public string $title;
    public string $key;
    public $inputClass;
    public string $onChangeJS = '';
    public string $child = '';
    public string $parent = '';

    /**
     * @param  string                                                                             $title
     * @param  string                                                                             $key
     * @param  TextInput|CheckboxInput|LinkInput|RangeInput|SelectInput|TextareaInput|ImageInput  $inputClass
     * @param  string|null                                                                        $onChangeJs
     */
    public function __construct(
        string $title,
        string $key,
        $inputClass,
        string $onChangeJs = '',
        string $child = '',
        string $parent = ''
    ) {
        $this->title = $title;
        $this->key = $key;
        $this->inputClass = $inputClass;
        $this->onChangeJS = $onChangeJs;

        $this->child = $child;
        $this->parent = $parent;
    }
}