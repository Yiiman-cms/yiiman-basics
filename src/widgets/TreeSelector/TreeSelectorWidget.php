<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\TreeSelector;


use kartik\base\InputWidget;
use phpDocumentor\Reflection\Types\This;
use YiiMan\YiiBasics\widgets\TreeSelector\TreeSelectorAsset;
use yii\helpers\ArrayHelper;

class TreeSelectorWidget extends InputWidget
{
    private static $parental = [];
    private static $template =
        [
            'head' => '<ol id="auto-checkboxes-{id}" data-name="{name}">{items}</ol>',
            'item' => '<li {id}>{title} {items}</li>',
            'second_head' => '<ol>{items}</ol>'
        ];
    public $data = [];

    public function run()
    {
        TreeSelectorAsset::register($this->view);
        $items = $this->data;
        self::$parental = ArrayHelper::index($items, null, 'parent');
        $idial = ArrayHelper::index($items, 'id');
        $all = [];


        foreach ($idial as $id => $item) {
            $all[] = self::buildItem($idial, $id);
        }


        $itemsHtml = '';

        foreach ($all as $item) {
            if (!empty($item['parent'])) {
                continue;
            }
            $itemsHtml .= self::getHtmlItem($item);
        }

        if (!empty($this->value)) {
            $value = json_encode($this->value);
        } else {
            $value = '[]';
        }

        $js = <<<JS
$('#auto-checkboxes-{$this->id}').bonsai(
    {

	  expandAll: true,

	  checkboxes: true,

	  createInputs: 'checkbox',
        
      checkedIds: {$value}
	}
);
JS;
        $this->view->registerJs($js, $this->view::POS_END);


        return str_replace([
            '{items}',
            '{id}',
            '{name}'
        ], [
            $itemsHtml,
            $this->id,
            $this->name.'[]'
        ], self::$template['head']);

    }


    private static function buildItem($items, $id)
    {

        $array = [];

        $array['label'] = $items[$id]['title'];
        $array['id'] = $items[$id]['id'];
        $array['parent'] = $items[$id]['parent'];
        $subItems = [];
        if (!empty(self::$parental[$id])) {
            foreach (self::$parental[$id] as $sid => $sub) {
                $subItems[] = self::buildItem($items, $sub['id']);
            }
        }
        $array['items'] = $subItems;
        return $array;
    }


    private static function getHtmlItem($item)
    {
        if (empty($item['items'])) {

            $s1 = str_replace(
                [
                    '{id}',
                    '{title}',
                    '{items}'
                ],
                [
                    'data-value="'.$item['id'].'"',
                    !empty($item['label']) ? $item['label'] : $item['title'],
                    ''
                ],
                self::$template['item']
            );


            return $s1;
        } else {

            $itemsHtml = '';
            foreach ($item['items'] as $i) {
                $itemsHtml .= self::getHtmlItem($i);
            }


            $s1 = str_replace(
                ['{items}'],
                $itemsHtml,
                self::$template['second_head']
            );
            $s2 = str_replace(
                [
                    '{items}',
                    '{title}',
                    '{id}'
                ],
                [
                    $s1,
                    $item['label'],
                    'data-value="'.$item['id'].'"'
                ],
                self::$template['item']
            );

            return $s2;
        }
    }
}
