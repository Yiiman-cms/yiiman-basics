<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\menumodern\models;

use YiiMan\YiiBasics\modules\slug\models\Slug;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "fc_menu".
 * @property integer $id
 * @property string  $name
 * @property integer $parent_id
 * @property string  $url
 * @property string  $icon
 * @property string  $menuType
 * @property integer $parent
 * @property integer $right
 * @property integer $child
 * @property integer $child2
 */
class Menu extends \yii\db\ActiveRecord
{
    const LOCATION_TOP = 1;
    const LOCATION_BOTTOM_LEFT = 2;
        const LOCATION_BOTTOM_MIDDLE = 3;//برای انتخاب زیر منوی سطح 1 استفاده میشود
        const LOCATION_BOTTOM_RIGHT = 4;//برای انتخاب سطح سوم استفاده میشود
    const TYPE_URL = 1;
    const TYPE_PAGE = 2;
    const TYPE_PRODUCT = 3;
    const STATUS_PUBLISHED = 1;
    const STATUS_REVIEW = 0;
    static private $locations = [];
    static private $hints = [];
    static private $types = [];
    static private $loaded = false;
    static private $menus = [];
    public $parent;
    public $right;
public $child;
public $child2;
    public $pos;
    public $slug;

    public static function generateSlug($slug)
    {
        return str_replace(
            [
                ' ',
                '-',
                '.',
                '/',
                '\\',
                '&',
                '$',
                '%',
                '^',
                '!',
                '#',
                '~',
                '`'
            ],
            [
                '',
                '_',
                '_',
                '_',
                '_',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                ''
            ],
            $slug
        );
    }

    /**
     * این تابع را برای تنظیم موقعیت های منو تنظیم کنید، هر جایی از سیستم که میتوان یک منو قرارداد را به این تابع معرفی کنید تا در بک اند قابل استفاده باشد
     * شکل آرایه:
     * [
     *      'key'=>'label',
     *      'key'=>'label',
     * ]
     * @param $array
     */
    public static function addLocations($array)
    {
        foreach ($array as $key => $label) {

            self::$locations[$key] = $label;
        }
    }

    public static function getLocations()
    {
        return self::$locations;
    }

    public static function getHints()
    {
        return self::$hints;
    }

    public static function changeHint($hint, $text)
    {
        self::$hints[$hint] = $text;
    }

    public static function addTypes($array)
    {
        self::$types = $array;
    }

    public static function getTypes()
    {
        self::loadType();
        return self::$types;
    }

    public static function loadType()
    {
        if (!self::$loaded) {
            self::$types = ArrayHelper::index(self::$types, 'name');

            self::$loaded = true;
        }
    }

    public static function getType($name)
    {
        self::loadType();
        return self::$types[$name];
    }

    private static function getSlug($model)
    {
        $slug = Slug::findOne([
            'table_name' => self::tableName(),
            'table_id'   => $model['id']
        ]);
        if (!empty($slug)) {
            return $slug->slug;
        } else {
            return '';
        }
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return
            [
                [
                    [
                        'name',
                        'menuType',
                        'menuContentType'
                    ],
                    'required'
                ],
                [
                    [
                        'parent_id',
                        'parent',
                        'right',
                        'child',
                        'child2',
                        'column',
                        'enable',
                        'position'
                    ],
                    'integer'
                ],
                [
                    [
                        'name',
                        'icon',
                        'menuType',
                        'menuContentType'
                    ],
                    'string',
                    'max' => 100
                ],
                [
                    [
                        'name',
                        'img'
                    ],
                    'string',
                    'max' => 100
                ],
                [
                    [
                        'url',
                        'hyper_url',
                        'pos'
                    ],
                    'string',
                    'max' => 1000
                ],

            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'              => 'ID',
            'name'            => Yii::t('menumodern', 'نام منو'),
            'parent_id'       => Yii::t('menumodern', 'منوی والذ'),
            'menuType'        => Yii::t('menumodern', 'نوع منو'),
            'url'             => Yii::t('menumodern', 'url'),
            'position'        => Yii::t('menumodern', 'مکان منو'),
            'menuContentType' => Yii::t('menumodern', 'نوع محتوای منو'),
            'img'             => Yii::t('menumodern', 'لینک تصویر'),
            'enable'          => Yii::t('menumodern', 'وضعیت'),
            'column'          => Yii::t('menumodern', 'تعداد ستون ها'),
            'hyper_url'       => Yii::t('menumodern', 'Hyper Url'),
            'parent'          => \Yii::t('menumodern', 'منوی اصلی والد'),
            'right'           => \Yii::t('menumodern', 'تب منوی والد'),
            'child'           => \Yii::t('menumodern', 'زیر منوی سطح 1 والد'),
            'pos'             => \Yii::t('menumodern', 'موقعیت منو'),
            'icon'            => \Yii::t('menumodern', 'آیکون منو')
        ];
    }

    public function attributeHints()
    {
        return ArrayHelper::merge(
            [
                'pos'       => 'میتوانید بر اساس عدد، منوهای خود را مرتب سازی کنید. سپس در بخش نمای سایت، بر اساس اعدادی که اینجا وارد کرده اید، منوها از بالا به پایین لیست میشوند. اعداد کوچکتر اول ظاهر میشوند',
                'parent'    => 'لطفا انتخاب کنید تب منوی شما ذیل کدام منوی اصلی قرار بگیرد؟',
                'right'     => 'لطفا انتخاب کنید تب منوی شما ذیل کدام تب منو قرار بگیرد؟',
                'child'     => 'لطفا انتخاب کنید زیر منوی سطح 2 شما باید ذیل کدام زیر منوی سطح یک در این تب قرار بگیرد؟',
                'url'       => 'این بخش در واقع همان لیست دسته بندی محصولات است و با افزودن یک دسته ی جدید این لیست بروز میشود',
                'hyper_url' => 'چنانچه قصد دارید این منو را به یک آدرس اینترنتی(نه یک دسته بندی محصول) متصل کنید، در این فیلد آدرس کامل را وارد کنید.',
                'column'    => 'مشخص کنید منوهای داخل تب منوها، به چند ستون تقسیم شوند؟ عدد انتخابی باید بین 1 تا 4 باشد',
                'enable'    => 'با غیر فعال سازی یک منو، بطور موقت از دسترس کاربران سایت خارح میشود تا زمانی که مجددا تصمیم به فعال سازی آن بگیرید',

            ],
            self::$hints
        );
    }

}
