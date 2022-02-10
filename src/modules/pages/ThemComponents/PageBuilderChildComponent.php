<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/10/2022 AD 18:28
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents;

/**
 * @property string $class_regex    An array with regexs used for class names to allow the editor to detect the Component when clicking on the corresponding node, example classesRegex: ["col-"], this regex is used by Grid Component to detect bootstrap columns such as col-md-3 or col-sm-6.
 * @property string $childComponent Sometimes you need to edit a component that is inside the parent component, for this you can use child property the value must be Class extended from 'PageBuilderComponent' class.
 */
class PageBuilderChildComponent
{

    public string $class_regex;
    public $childComponent;

    public function __construct(string $ChildComponent = '', string $class_regex = '')
    {
        $this->childComponent = $ChildComponent;
        $this->class_regex = $class_regex;
    }
}