<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/7/2022 AD 21:41
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents;

use YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs\SelectInput;

/**
 * @property array                     $nodes
 * @property string                    $classes
 * @property PageBuilderChildComponent $children
 */
abstract class PageBuilderComponent implements PageBuilderComponentInterface
{

    public array $nodes = [];
    public array $classes = [];


    private function createItem(&$array, $key, $value, $isobject = false)
    {
        $array .= $key.':'.($isobject ? '' : '"').$value.($isobject ? '' : '"').",\n";
    }

    public function generateProperties()
    {
        $properties = $this->properties()->properties;
        $generated = "[\n";
        if (!empty($properties)) {
            foreach ($properties as $key => $item) {
                /**
                 * @var $item PagebuilderComponentProperty
                 */
                $generated .= "{\n";

                $this->createItem($generated, 'name', $item->title);
                $this->createItem($generated, 'key', $item->key);
                $this->createItem($generated, 'inputtype', $item->inputClass::JsExtendCode(), true);

                if (!empty($item->inputClass->htmlAttributeName)) {
                    $this->createItem($generated, 'htmlAttr', $item->inputClass->htmlAttributeName);
                }

                if (!empty($item->child)) {
                    $this->createItem($generated, 'child', $item->child);
                }
                if (!empty($item->parent)) {
                    $this->createItem($generated, 'parent', $item->parent);
                }



                if (!empty($item->inputClass->onChange)) {
                    $this->createItem($generated, 'onChange', 'function(node){'.$item->inputClass->onChange.'}', true);
                }

                switch (true){
                    case $item->inputClass instanceof SelectInput:
                        $this->createItem($generated,'data','{options:'.$item->inputClass->generateOptions().'}',true);
                        $this->createItem($generated,'validValues',json_encode($item->inputClass->validValues),true);
                            break;
                }

                $generated .= "},\n";
            }
        }
        return $generated .= "\n]";
    }
}