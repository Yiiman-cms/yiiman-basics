<?php
/**
 * @author ifo@yiiman.ir
 * @copyright Yiiman.ir @2020
 * @version 0.1
 */

namespace YiiMan\YiiBasics\widgets\nestedItems;


use YiiMan\YiiBasics\lib\ActiveRecord;
use YiiMan\YiiBasics\widgets\TreeSelector\TreeSelectorAsset;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

/**
 *
 * Class NestedItems
 * @property ActiveRecord[]|null $dataModel
 * @property [] $attributes
 * @property [] $template
 * @property [] $parental
 * @property [] $fieldsCallbacks
 * @property [] $customFields آرایه ای از فیلد های جدید که مقدار یکی از فیلد های موجود را داخل فیلد جدید می اندازد و داخل کال بک قابل استفاده است
 * @property string $parent_attribute
 * @package YiiMan\YiiBasics\widgets\nestedItems
 */
class NestedItems extends Widget
{
    /**
     * آرایه ای از مدل ها
     * @var array
     */
    public $dataModel = [];

    /**
     * مشخص کنید کدام نام فیلدی که به والد اشاره دارد چیست
     * @var string
     */
    public $parent_attribute ;

    /**
     * آرایه ای از فیلد های جدید
     * که مقدار یکی از فیلد های موجود را داخل فیلد جدید می اندازد
     * و داخل کال بک قابل استفاده است
     * @var array
     */
    public $customFields = [];

    /**
     * آرایه ای از کال بک ها
     * در این آرایه کلید پارامتر را مشخص میکنید، و سیستم در یک کال بک به شما مقدار آن فیلد را برمیگرداند و میتوانید آن را فیلتر و به شکل مورد دلخواه خود تغییر دهید.
     * @var array
     */
    public $fieldsCallbacks = [];

    public $template =
        [
            'head' => '<ul>{items}</ul>',


            'item_head' => '<li>{item}</li>',
            'item_body' => '<a href="{url}">{title}</a>',


            'item_with_child_head' => '<li class="dropdown">{item}</li>',
            'item_with_child_body' => '<a>{title}</a><ul>{items}</ul>',
        ];

    /**
     * محدودیت عمق آرایه برای نمایش
     * @var int
     */
    public $nestedLimit = 0;

    private $attributes = [];

    private $flipped_attributes = [];

    private $vals = [];

    private $parental = [];

    private $nested=1;

    public function run()
    {

        if (empty($this->dataModel)) {
            return '';
        }

        $items = $this->dataModel;
        if (!empty($this->parent_attribute)){
            $this->parental = ArrayHelper::index($items, null, $this->parent_attribute);
        }
        $idial = ArrayHelper::index($items, 'id');
        $all = [];


        foreach ($idial as $id => $item) {
            if (!empty($item[$this->parent_attribute])) {
                continue;
            }
            $all[] = $this->buildItem($idial, $id);
        }


        $itemsHtml = '';

        foreach ($all as $item) {
            if (!empty($item[$this->parent_attribute])) {
                continue;
            }
            $this->nested=1;
            $itemsHtml .= $this->getHtmlItem($item);
        }


        $vals = ArrayHelper::merge([$itemsHtml], $this->vals);
        return str_replace($this->attributes(), $vals, $this->template['head']);

    }


    private function buildItem($items, $id)
    {

        $array = [];


        // < Generate Attributes >
        {
            $attrs = $items[$id]->attributes;
            $this->attributes = [];
            $this->vals = [];
            foreach ($attrs as $attr => $val) {
                $this->attributes[] = $attr;
                $this->vals[] = $val;

                $array[$attr] = $val;
            }
            $this->flipped_attributes = array_flip($this->attributes);
            $this->generateCustomFields();

            foreach ($this->fieldsCallbacks as $attr => $function) {
                $valID = $this->flipped_attributes[$attr];
                $this->vals[$valID] = $function($this->vals[$valID]);

                $array[$attr] = $this->vals[$valID];
            }
        }
        // </ Generate Attributes >

        if (!isset($this->flipped_attributes['id'])) {
            throw new BadRequestHttpException('ویجت Nestedtems فقط با مدل هایی که دارای پارامتر id هستند کار میکند');
        }


        $subItems = [];
        if (!empty($this->parental)){
            if (!empty($this->parental[$id])) {
                foreach ($this->parental[$id] as $sid => $sub) {
                    $subItems[] = $this->buildItem($items, $sub['id']);
                }
            }
        }
        if (!empty($subItems)) {
            $array['items'] = $subItems;
        }
        return $array;
    }

    private function attributes($withItems = true)
    {
        $p = [];
        if ($withItems) {
            $p [] = '{items}';
        }
        foreach ($this->attributes as $attr) {
            $p[] = '{' . $attr . '}';
        }

        return $p;
    }

    /**
     * generate custom fields for use in
     */
    private function generateCustomFields()
    {

        foreach ($this->customFields as $customAttr => $attr) {
            $this->attributes[] = $customAttr;
            $this->vals[] = $this->vals[$this->flipped_attributes[$attr]];
        }
        $this->flipped_attributes = array_flip($this->attributes);
    }


    private function generateClassParameters($item)
    {

        // < Generate Attributes >
        {
            $attrs = $item;
            $this->attributes = [];
            $this->vals = [];
            foreach ($attrs as $attr => $val) {
                if ($attr == 'items') {
                    continue;
                }
                $this->attributes[] = $attr;
                $this->vals[] = $val;
            }
            $this->flipped_attributes = array_flip($this->attributes);
            $this->generateCustomFields();
            if (!empty($this->parent_attribute)){
                foreach ($this->fieldsCallbacks as $attr => $function) {
                    $valID = $this->flipped_attributes[$attr];
                    $this->vals[$valID] = $function($this->vals[$valID]);
                }
            }
        }
        // </ Generate Attributes >

    }

    private function getHtmlItem($item)
    {

        if (empty($item['items'])) {

            $this->generateClassParameters($item);

            $attrs = $this->attributes();
            $vals = $this->vals;
            $s1 = str_replace(
                $attrs,
                ArrayHelper::merge([''], $vals),
                $this->template['item_body']
            );


            $s2 = str_replace(
                ['{item}'],
                $s1,
                $this->template['item_head']
            );
            return $s2;
        } else {

            $itemsHtml = '';
            // < check nested Limit >
            {

                    if (!empty($this->parent_attribute)){
                        foreach ($item['items'] as $i) {

                            if ($this->nestedLimit>0 && $this->nested>$this->nestedLimit){
                                continue;
                            }
                            if ($this->nestedLimit>0){
                                $this->nested=$this->nested+1;
                            }
                            $itemsHtml .= $this->getHtmlItem($i);
                        }
                    }

            }
            // </ check nested Limit >


            $this->generateClassParameters($item);

            $s1 = str_replace(
                $this->attributes(),
                ArrayHelper::merge([$itemsHtml], $this->vals),
                !empty($this->template['item_with_child_body']) ? $this->template['item_with_child_body'] : $this->template['item_body']
            );


            $vals = ArrayHelper::merge([$s1], $this->vals);
            $attrs = $this->attributes();
            $s2 = str_replace(
                $attrs,
                $vals,
                !empty($this->template['item_with_child_head']) ? $this->template['item_with_child_head'] : $this->template['item_head']
            );

            return $s2;
        }
    }
}
