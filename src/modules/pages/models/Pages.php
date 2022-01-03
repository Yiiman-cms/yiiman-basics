<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\pages\models;

use Codeception\PHPUnit\Constraint\Page;
use YiiMan\YiiBasics\lib\ActiveRecord;
use YiiMan\YiiBasics\modules\menu\models\Menu;
use YiiMan\YiiBasics\modules\slug\models\Slug;
use Yii;
use yii\helpers\ArrayHelper;
use function basename;

/**
 * This is the model class for table "{{%module_pages}}".
 * @property int    $id
 * @property string $slug
 * @property string $content
 * @property int    $status
 * @property int    $default
 * @property string $seo_description
 * @property string $back
 * @property string $tags
 * @property string $title
 * @property string $image
 * @property string $template قالب استفاده شده برای صفحه
 * @property string $created_at
 * @property string $updated_at
 * @property Menu[] $menus
 */
class Pages extends ActiveRecord
{

    const SEO_DESCRIPTION_METADATA = 'PAGE_SEO_DESC';
    const SEO_TAG = 'PAGE_SEO_TAG';
    const SEO_META_NAME = 'Pages';
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;
    private static $templates = [];
    private static $loaded = false;
    public $tags;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_pages}}';
    }

    public static function generateUrl($pageModel)
    {
        $slug = Slug::getSlug($pageModel);
        if (!empty($slug)) {
            return Yii::$app->Options->URL.'/'.$slug;
        } else {
            return Yii::$app->Options->URL.'/page/'.$pageModel->id;
        }
    }

    /**
     * افزودن استایل برگه
     * @param $itemArray
     */
    public static function addTemplates($itemArray)
    {
        self::$templates = $itemArray;
    }

    /**
     * دریافت همه ی استایل های برگه
     * @return array
     */
    public static function getAllTemplates()
    {
        self::loadTemplates();
        return self::$templates;
    }

    private static function loadTemplates()
    {
        if (!self::$loaded) {
            self::$templates = ArrayHelper::index(self::$templates, 'name');
            self::$loaded = true;
        }
    }

    /**
     * دریافت قالب برگه بوسیله ی نام آن
     * @param $name
     * @return mixed
     */
    public static function getTemplate($name)
    {
        self::loadTemplates();
        return self::$templates[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'content',
                    'status',
                    'title',
                    'template'
                ],
                'required'
            ],
            [
                [
                    'content',
                    'seo_description'
                ],
                'string'
            ],
            [
                [
                    'status',
                    'language',
                    'default'
                ],
                'integer'
            ],
            [
                [
                    'title',
                    'template'
                ],
                'string',
                'max' => 255
            ],
            [
                [
                    'tags',
                    'created_at',
                    'updated_at',
                    'back'
                ],
                'safe'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'              => Yii::t('pages', 'شناسه'),
            'content'         => Yii::t('pages', 'محتوا'),
            'status'          => Yii::t('pages', 'وضعیت انتشار'),
            'seo_description' => Yii::t('pages', 'توضیحات سئو'),
            'tags'            => Yii::t('pages', 'تگ ها'),
            'title'           => Yii::t('pages', 'عنوان برگه'),
            'default'         => Yii::t('pages', 'صفحه ی نخست'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['page' => 'id']);
    }

    public function getTags()
    {
        $tags = Yii::$app->MetaLib->get('PAGE_SEO_TAG', $this->id);
        if (is_array($tags)) {
            return $tags;
        } else {
            if (is_object($tags)) {
                return [$tags];
            }
        }
    }

    /**
     * این ردیف را به عنوان صفحه ی نخست انتخاب کنید
     * @return bool
     */
    public function setDefault()
    {
        $model = self::find()->where(['language' => Yii::$app->Language->contentLanguageID()])->andWhere([
            '>',
            'default',
            0
        ])->all();
        if (!empty($model)) {
            foreach ($model as $m) {
                /**
                 * @var $m Pages
                 */
                $m->default = 0;
                $m->save();
            }
        }


        $model = Pages::findOne($this->id);
        if (!empty($model)) {
            $model->default = 1;
            if ($model->save()) {
                return true;
            }
        }
        return false;

    }
}
