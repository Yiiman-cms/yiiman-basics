<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\menu\models;

use Codeception\PHPUnit\Constraint\Page;
use danog\MadelineProto\Stream\Transport\PremadeStream;
use YiiMan\YiiBasics\lib\ActiveRecord;
use YiiMan\YiiBasics\modules\slug\models\Slug;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\validators\UrlValidator;

/**
 * This is the model class for table "{{%module_menu}}".
 * @property int    $id       Id
 * @property string $title    Title
 * @property string $url      Url
 * @property int    $page     Page
 * @property int    $location Location
 * @property string $icon     Icon
 * @property string $image    Image
 * @property int    $status   Status
 * @property int    $product  Product
 * @property int    $index    Menu index
 * @property int    $type     Url type(page,product,url)
 */
class Menu extends ActiveRecord
{

    const LOCATION_TOP = 1;
    const LOCATION_BOTTOM_LEFT = 2;
    const LOCATION_BOTTOM_MIDDLE = 3;
    const LOCATION_BOTTOM_RIGHT = 4;
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
    private static $parental;
    private static $namialTypes;
    public $slug;

    public static function getSimple_li_tags($location, $Li_options = [], $a_options = [])
    {
        $menus = self::getAllActived($location, true);
        if (!empty($menus)) {
            $html = '';
            foreach ($menus as $item) {

                $tag_a = Html::a($item['title'], self::generateUrl($item), $a_options);
                $html .= Html::tag('li', $tag_a, $Li_options);
            }
            return $html;
        } else {
            return '';
        }
    }

    /**
     * @return array|\YiiMan\YiiBasics\modules\menu\models\Menu[]|\yii\db\ActiveRecord[]
     */
    public static function getAllActived($location, $array = true)
    {
        if (empty(self::$menus)) {

            $query = self::find()
                ->where([
                    'status'   => self::STATUS_PUBLISHED,
                    'location' => $location,
                    'language' => Yii::$app->Language->currentID()
                ])
                ->orderBy(['index' => SORT_ASC]);
            if ($array) {
                $query = $query->asArray();
            }
            self::$menus [$location] = $query->all();


            return self::$menus[$location];
        } else {
            if ($array && !empty(self::$menus[$location]) && is_array(self::$menus[$location])) {
                return self::$menus[$location];
            } else {
                if (!$array && !empty(self::$menus[$location]) && is_object(self::$menus[$location])) {
                    return self::$menus[$location];
                }
            }
        }
    }

    /**
     * @param  array  $model
     */
    private static function generateUrl(array $model)
    {
        switch ($model['type']) {
            case self::TYPE_PAGE:
            case self::TYPE_PRODUCT:
                $slug = self::getSlug($model);
                if (!empty($slug)) {
                    return Yii::$app->Options->URL.'/'.$slug;
                } else {
                    return Yii::$app->Options->URL.'/page/'.$model['related_id'];
                }
                break;
            case self::TYPE_URL:
                if (!empty($model['slug'])) {
                    return $model['url'];
                }
                break;
        }
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
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_menu}}';
    }

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

    public static function changeHint($hint, $text)
    {
        self::$hints[$hint] = $text;
    }

    /**
     * کل منو را به صورت html همانند یک ویجت کامل بازگردانی میکند
     * @param  int    $location   آی دی مکان منو
     * @param  int    $cacheTime  زمانی که نیاز به کش دارید
     * @param  array  $options    کانفیگ های مد نظر
     * @return string
     */
    public static function getMenuHtml($location, $cacheTime, $options = [])
    {
        $items = self::getAllActiveForWidget($location);

        // < options >
        {
            $options = ArrayHelper::merge(
                [
                    'head_ul_template'           => '<ul>{items}</ul>',
                    'items_template'             => '<li>{item}</li>',
                    'has_child_items_template'   => '<li class="dropdown">{item}</li>',
                    'has_child_in_item_template' => '<a>{title}</a><ul>{items}</ul>',
                    'in_item_template'           => '<a href="{url}">{title}</a>'
                ], $options
            );
        }
        // </ options >
        $itemsHtml = '';

        foreach ($items as $item) {
            if (!empty($item['parent_id'])) {
                continue;
            }
            $itemsHtml .= self::getHtmlItem($item, $options);
        }

        return str_replace('{items}', $itemsHtml, $options['head_ul_template']);
    }

    public static function getAllActiveForWidget($location)
    {
        $items = self::getAllActived($location, true);
        self::$parental = ArrayHelper::index($items, 'parent_id');
        $idial = ArrayHelper::index($items, 'id');
        $all = [];

        if (Yii::$app->Language->currentID() != Yii::$app->Language->defaultLanguageID()) {
            $homeUrl = '/'.Yii::$app->Language->defaultLanguage()->shortCode;
        } else {
            $homeUrl = Yii::$app->urlManager->createUrl(['/']);
        }

        $all[] = [
            'label' => \Yii::t('site', 'صفحه اصلی'),
            'url'   => $homeUrl
        ];
        foreach ($idial as $id => $item) {
            $all[] = self::buildItem($idial, $id);
        }
        return $all;
    }

    private static function buildItem($items, $id)
    {

        $parental = ArrayHelper::index($items, 'parent_id');
        $array = [];

        // < calculate Type >
        {
            if (empty(self::$namialTypes)) {
                self::$namialTypes = ArrayHelper::index(self::$types, 'name');
            }
            if (!empty(self::$namialTypes[$items[$id]['type']])) {
                $model = self::$namialTypes[$items[$id]['type']]['model']::findOne($items[$id]['related_id']);
                if (!empty($model)) {

                    $slug = Slug::getSlug($model);
                }

                if (!empty($slug)) {
                    $array['url'] = Yii::$app->urlManager->createUrl([$slug]);
                } else {
                    $menu = Menu::findOne($id);
                    $slug = Slug::getSlug($menu);
                    if (!empty($slug)) {
                        $array['url'] = Yii::$app->urlManager->createUrl([$slug]);
                    } else {
                        $array['url'] = Yii::$app->urlManager->createUrl(['/'.$items[$id]['type'].'/'.$items[$id]['related_id']]);
                    }
                }
            } else {


                // < calculate URL >
                {
                    $patternSche = '/^{schemes}:\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i';
                    // make sure the length is limited to avoid DOS attacks
                    if (is_string($items[$id]['url']) && strlen($items[$id]['url']) < 2000) {
                        if (strpos($items[$id]['url'], '://') === false) {
                            $items[$id]['url'] = Yii::$app->urlManager->createUrl([$items[$id]['url']]);
                        }

                        if (strpos($patternSche, '{schemes}') !== false) {
                            $pattern = str_replace('{schemes}', '('.implode('|', [
                                    'http',
                                    'https'
                                ]).')', $patternSche);
                        } else {
                            $pattern = $patternSche;
                        }


                        if (preg_match($pattern, $items[$id]['url'])) {
                            $array['url'] = $items[$id]['url'];
                        }
                    } else {
                        $array['url'] = Yii::$app->urlManager->createUrl([$items[$id]['url']]);
                    }
                }
                // </ calculate URL >


                $array['url'] = $items[$id]['url'];

            }

        }
        // </ calculate Type >


        $array['label'] = $items[$id]['title'];

        $array['parent_id'] = $items[$id]['parent_id'];
        $array['font'] = !empty($items[$id]['font']) ? $items[$id]['font'] : '';
        $subItems = [];
        if (!empty(self::$parental[$id])) {
            $subItems[] = self::buildItem($items, self::$parental[$id]['id']);
        }
        $array['items'] = $subItems;
        unset($slug);
        unset($menu);
        return $array;
    }

    private static function getHtmlItem($item, $options)
    {
        if (empty($item['items'])) {

            $s1 = str_replace(
                [
                    '{url}',
                    '{title}'
                ],
                [
                    $item['url'],
                    $item['label']
                ],
                $options['in_item_template']
            );

            $s2 = str_replace(
                ['{item}'],
                $s1,
                $options['items_template']
            );
            return $s2;
        } else {

            $itemsHtml = '';
            foreach ($item['items'] as $i) {
                $itemsHtml .= self::getHtmlItem($i, $options);
            }

            $s1 = str_replace(
                [
                    '{items}',
                    '{title}'
                ],
                [
                    $itemsHtml,
                    $item['label']
                ],
                $options['has_child_in_item_template']
            );

            $s2 = str_replace(
                ['{item}'],
                $s1,
                $options['has_child_items_template']
            );
            return $s2;
        }
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return
            [
                [
                    [
                        'location',
                        'status',
                        'related_id',
                        'index',
                        'language',
                        'parent_id'
                    ],
                    'integer'
                ],
                [
                    [
                        'title',
                        'url',
                        'icon',
                        'image',
                        'type'
                    ],
                    'string',
                    'max' => 255
                ],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'       => Yii::t('menu', 'شناسه'),
            'title'    => Yii::t('menu', 'نام منو'),
            'url'      => Yii::t('menu', 'لینک'),
            'slug'     => Yii::t('menu', 'نامک'),
            'location' => Yii::t('menu', 'موقعیت نمایش'),
            'icon'     => Yii::t('menu', 'آیکون'),
            'image'    => Yii::t('menu', 'تصویر'),
            'status'   => Yii::t('menu', 'وضعیت انتشار'),
            'index'    => Yii::t('menu', 'ترتیب'),
            'type'     => Yii::t('menu', 'نوع منو'),
        ];
    }

    public function attributeHints()
    {
        return ArrayHelper::merge(
            [
                'index' => Yii::t('menu', 'این یک شماره برای ترتیب بندی منوهاست'),
                'url'   => Yii::t('menu', ''),
                'slug'  => Yii::t('menu', 'این نام برای لینک کردن مستقیم منو به محتواست'),
                'icon'  => Yii::t('menu', 'برای ایکون از کلاس های فونت آوسام استفاده کنید'),
                'type'  => Yii::t('menu', 'انتخاب کنید تا ورودی ها نمایان شوند'),
            ],
            self::$hints
        );

    }
}
