<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\widget\models;


class Components
{

    public static $styles = [];
    private static $components = [];

    private static $changed = false;

    public static function setComponents($array)
    {
        self::$components = $array;
    }

    public static function getAllComponents()
    {
        self::loadComponents();
        return self::$components;
    }

    private static function loadComponents()
    {
        if (!self::$changed) {
            if (!empty(self::$components)) {
                foreach (self::$components as $catKey => $cat) {
                    foreach ($cat['items'] as $key => $item) {
                        self::$components[$catKey]['items'][$key]['image'] = \Yii::getAlias('@system').'/theme/components/'.$item['name'].'/image.png';
                        self::$components[$catKey]['items'][$key]['content'] = \Yii::getAlias('@system').'/theme/components/'.$item['name'].'/index.html';
                    }
                }
            }
        }
    }

    private static function systemComponents()
    {
        return
            [
                [
                    'name'  => \Yii::t('widget', 'بوت استرپ'),
                    'items' =>
                        [
                            [
                                'name'        => 'col',
                                'description' => \Yii::t('widget', 'سه ستون')
                            ]
                        ],
                ]
            ];
    }
}
