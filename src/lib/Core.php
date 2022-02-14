<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib;


use phpDocumentor\Reflection\Types\This;
use YiiMan\YiiBasics\modules\blog\models\BlogArticles;
use YiiMan\YiiBasics\modules\blog\models\BlogCategory;
use YiiMan\YiiBasics\modules\hint\models\Hint;
use YiiMan\YiiBasics\modules\menumodern\models\Menu;
use YiiMan\YiiBasics\modules\pages\models\Pages;
use YiiMan\YiiBasics\modules\pages\ThemComponents\ComponentClass;
use YiiMan\YiiBasics\modules\pages\ThemComponents\PageBuilderComponent;
use YiiMan\YiiBasics\modules\parameters\models\Parameters;
use YiiMan\YiiBasics\modules\posttypes\models\Posttypes;
use YiiMan\YiiBasics\modules\rbac\models\Item;
use YiiMan\YiiBasics\modules\search\models\Search;
use YiiMan\YiiBasics\modules\slug\models\Slug;
use YiiMan\YiiBasics\modules\widget\models\Components;
use yii\helpers\ArrayHelper;
use YiiMan\YiiBasics\modules\widget\models\Widget;

/**
 * Class Core
 * @package YiiMan\YiiBasics\lib
 */
class Core
{
    public static $enabledLanguage = true;
    public static $enabledCache = true;
    public static $uploadDir;
    public static $uploadURL;
    public static $SiteURL;
    public static $SiteAdminURL;
    public static $dbName;
    public static $dbNameTest;
    public static $dbPort;
    public static $dbHost;
    public static $dbUsername;
    public static $dbPassword;
    public static $hasRBAC = false;
    public static $superAdminID = 1;
    public static $pageBuilderComponents =[];
    public static $LogLevel = [
        'error',
        'warning'
    ];
    private static $dashboardStat = [];
    private static $configKeys = [];
    private static $notificationNames = [];
    private static $permissions = [];
    private static $appIDS =
        [
            'app-backend'  => 'ادمین پنل',
            'app-console'  => 'کنسول',
            'app-frontend' => 'فرانت سایت'
        ];

    /**
     * آیدی های برنامه های نوشته شده در این پروژه را مشخص کنید تا بتوان آنها را در ماژول ثبت لاگ متمایز نمود.
     * @param  string[]  $array
     */
    public static function setAppsList(
        $array =
        [
            'app-backend'  => 'ادمین پنل',
            'app-console'  => 'کنسول',
            'app-frontend' => 'فرانت سایت'
        ]
    ) {
        self::$appIDS = $array;
    }


    public static function getAppsList()
    {
        return self::$appIDS;
    }

    /**
     * آرایه ای شامل پارامتر های مدنظر که به صورت یکجا ثبت میشود
     * این آرایه ها در هر جای سیستم قابل بازخوانی هستند، همچنین به طور خودکار بر روی ویجت های ورود محتوی برای استفاده درج میشوند
     * Sample Array:
     * [
     *      [
     *          'description'=>'',
     *          'key'=>'',
     *          'val'=>''
     *      ],
     *      [
     *          'description'=>'',
     *          'key'=>'',
     *          'val'=>'',
     *      ],
     * ]
     * @param $array
     */
    public static function addParameters($array)
    {
        Parameters::addParameters($array);
    }





    public static function addMenuLocations($array)
    {
        \YiiMan\YiiBasics\modules\menu\models\Menu::addLocations($array);
    }

    /**
     * add widget locations for admin
     * sample array stracture:
     * [
     *  'footerRight'=>'فوتر راست'
     * ]
     */
    public static function AddThemeLocations($array)
    {
        \YiiMan\YiiBasics\modules\widget\models\Widget::addLocations($array);
    }

    /**
     * add default html listes for every widget in admin
     * @param  array  $array
     *                                  [
     *                                  'locationName'=>
     *                                  [
     *                                  [
     *                                  'title'=>'some title',
     *                                  'html'=>'HTML code'
     *                                  ]
     *                                  ]
     *                                  ]
     */
    public static function AddThemeLocationsDefaultValue(array $array)
    {
        Widget::addDefaultLocationCode($array);
    }


    public static function setMenuUrlHint($text)
    {
        \YiiMan\YiiBasics\modules\menu\models\Menu::changeHint('url', $text);
    }

    /**
     * لیست کامپوننت هایی که باید در ویرایشر صفحات و ویجت ها ظاهر شوند را وارد کنید
     * این کامپوننت ها باید در پوشه ی زیر موجود باشند:
     * crm_include\theme\components
     * آرایه ی نمونه:
     * [
     *      [
     *           'name' => 'جدول',
     *           'items' =>
     *                  [
     *                      [
     *                          'name' => 'table',
     *                          'label' => 'جدول 4 تایی',
     *                          'description' => ''
     *                      ]
     *                  ],
     *      ]
     * ]
     * @param $array
     */
    public static function setComponents($array)
    {
        Components::setComponents($array);
    }

    /**
     * تنظیم کامپوننت های بخش ویجت های صفحه ساز
     * @param  PageBuilderComponent[]  $components
     */
    public static function setPageBuilderComponents(array $components){
        static::$pageBuilderComponents=$components;
    }


    /**
     * یک استایل را به IFRAME باز شده در ماژول ویرایش برگه در بک اند اضافه میکند
     * این ماژول دو حالت نمایش تمام صفحه و فقط ویجت دارد، که برای هر کدام میتوانید استایل جدا تعریف کنید
     * @param $full
     * @param $justWidget
     */
    public static function widgetLayoutStyles($full, $justWidget)
    {
        Components::$styles['full'] = $full;
        Components::$styles['widget'] = $justWidget;
    }

    /**
     * افزودن استایل صفحات که موجب میشود در بک اند در ماژول ثبت برگه قابل تنظیم باشد
     * @param $array
     */
    public static function pageTemplates($array)
    {
        Pages::addTemplates($array);
    }

    /**
     * انواع اسلاگ و اکشن مربوطه را به سیستم اعلام میکند، تا در صورتی که صفحه ای با اسلاگ مربوطه یافت شد، سیستم مورد را به اکشن مربوطه ارجاع دهد
     * @param $array
     */
    public static function addSlug($array)
    {
        Slug::addSlugs($array);
    }

    /**
     * تایپ های مختلف منو را مشخص کنید، و به اکشن مربوطه ارجاع دهید
     * [
     *       [
     *           'name' => 'page',
     *           'action' => 'page',
     *           'params' => ['id'],
     *           'label' => 'برگه',
     *           'model' => \YiiMan\YiiBasics\modules\pages\models\Pages::className(),
     *           'modelMap' => ['id', 'title']
     *       ],
     *       [
     *           'name' => 'work',
     *           'action' => 'work',
     *           'params' => [null, 'id'],
     *           'label' => 'نمونه کار',
     *           'model' => \YiiMan\YiiBasics\modules\works\models\Works::className(),
     *           'modelMap' => ['id', 'title']
     *       ],
     *   ]
     * @param $array
     */
    public static function addMenuTypes($array)
    {
        Menu::addTypes($array);
    }

    /**
     * @param $array
     */
    public static function addFonts($array)
    {
        theme::addFonts($array);
    }

    /**
     * اگر قصد دارید روی اکشن خاصی آمار بازدید ثبت شود، آن اکشن را اینجا ثبت کنید
     * آرایه ی نمونه:
     *  [
     *       'controller_class_name' =>['action_name' => 'table_name']
     *  ]
     * @param $array
     */
    public static function configHints($array)
    {
        if (class_exists('YiiMan\YiiBasics\modules\hint\models\Hint')) {
            Hint::configHint($array);
        }
    }

    /**
     * مشخص کنید نتایج جست و جو به چه شکل نمایش داده شود، و از کدام مدل ها دریافت شود
     * [
     *      'view' => 'search',
     *      'types' =>
     *                  [
     *                      [
     *                          'label' => \Yii::t('site', 'مقالات یافت شده'),
     *                          'model' => \YiiMan\YiiBasics\modules\blog\models\BlogArticles::className(),
     *                          'search_field' => 'content',
     *                          'widget' =>
     *                                  [
     *                                          'template' => 'articleCard',//system/theme/components/articleCard
     *                                          'customFields' =>
     *                                                           [
     *                                                              'left' => 'created_at',
     *                                                              'author_text' => 'author',
     *                                                              'image' => 'id',
     *                                                           ],
     *                                          'fieldsCallbacks' =>
     *                                                           [
     *                                                              'author' => function ($id) {
     *                                                                      //someCode...
     *                                                                  },
     *                                                           ],
     *                                  ],
     *                      ]
     *                  ]
     * ]
     * @param $array
     */
    public static function addSearchItems($array)
    {
        Search::addConfigs($array);
    }

    /**
     * مشخص کنید نتایج صفحه ی دسته بندی ها به چه شکل نمایش داده شود
     * @param $array
     */
    public static function addCategoryItems($array)
    {
        BlogCategory::setConfigs($array);
    }

    public static function addAdminDashboardStat($array)
    {
        self::$dashboardStat = $array;
    }

    public static function getDashboardStat()
    {
        return self::$dashboardStat;
    }

    public static function addPostTypes($config = [])
    {
        $lastConfigs = Posttypes::getConfigs();
        Posttypes::addConfigs(array_merge_recursive($config, $lastConfigs));
    }

    public static function addConfig($key, $val)
    {
        self::$configKeys[$key] = $val;
    }

    public static function getConfig($key)
    {
        if (!empty(self::$configKeys[$key])) {
            return self::$configKeys[$key];
        }
        return '';
    }

    /**
     * مجوز هایی که در سامانه وجود دارد را تنظیم کنید
     * @param  array[]  $permissions
     */
    public static function Permissions(
        $permissions =
        [
            [
                'name'        => 'start',
                'description' => 'test'
            ]
        ]
    ) {
        self::$permissions = $permissions;
    }

    /**
     * @return array
     */
    public static function getPermissions(): array
    {
        return self::$permissions;
    }

    public static function getNotificationNames()
    {
        return self::$notificationNames;
    }

    /**
     *  * این تابع انواع بخش هایی که برای انها نوتیفیکیشن ارسال میشود را تعریف میکند.
     * نمونه ی آرایه ی مورد قبول:
     * ```php
     * [
     *      'ticket'=>//module name
     *      [
     *          'label'=>'تیکت ها',//module label
     *          'items'=>
     *              [
     *                  'ticket_answer'=>//module act name
     *                      [
     *                      'label'=>'پاسخ به تیکت',//module act label
     *                      'hint'=>'ارسال اطلاعیه در زمان پاسخ به تیکت',//module act hint
     *                      'params'=>// dynamic parameters
     *                          [
     *                              [
     *                                  'name'=>'نام',
     *                                  'family'=>'نام خانوادگی',
     *                              ]
     *                          ]
     *                  ]
     *              ]
     *      ]
     * ]
     * ```
     * @param $array
     */
    public static function setNotificationNames(
        $array =
        [
            'ticket' =>//module name (optional)
                [
                    'label' => 'تیکت ها',
                    //module label
                    'items' =>
                        [
                            'ticket_answer' => //module act name (required)
                                [
                                    'label'  => 'پاسخ به تیکت',
                                    //module act label
                                    'hint'   => 'ارسال اطلاعیه در زمان پاسخ به تیکت',
                                    //module act hint
                                    'params' =>// dynamic parameters
                                        [
                                            [
                                                'name'   => 'نام',
                                                'family' => 'نام خانوادگی',
                                            ]
                                        ]
                                ]
                        ]
                ]
        ]
    ) {

        self::$notificationNames = $array;
    }


}
