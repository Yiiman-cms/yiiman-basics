<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\slug\models;

use Mpdf\Tag\P;
use YiiMan\YiiBasics\modules\menu\models\Menu;
use YiiMan\YiiBasics\modules\pages\models\Pages;
use YiiMan\YiiBasics\modules\slug\controllers\DefaultController;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%module_slug}}".
 * @property int    $id
 * @property string $slug
 * @property string $table_name
 * @property int    $table_id
 */
class Slug extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    private static $slugs = [];
    private static $loaded = false;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_slug}}';
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
                '`',
                '<',
                '>',
                '(',
                ')',
                '|',
                '{',
                '}',
                '[',
                ']',
                '?',
                ';',
                ':'
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
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
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

    public static function checkSlug($slug)
    {
        $array = str_split($slug);
        if (!empty($array)) {
            foreach ($array as $char) {
                if (self::charCheck($char)) {
                    return false;
                }
            }

            return true;
        }

        return true;
    }

    private static function charCheck($char)
    {
        return in_array(
            $char,
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
                '`',
                '<',
                '>',
                '(',
                ')',
                '|',
                '{',
                '}',
                '[',
                ']',
                '?',
                ';',
                ':',
                '\'',
                '"',
                '*',
                '=',
                '@',
                '+'
            ]
        );
    }

    public static function update_post($model)
    {
        DefaultController::update($model);

        return true;
    }

    /**
     * Search Slug Model
     * @param $model
     * @return string
     */
    public static function getSlug($model)
    {
        $model = self::findOne([
            'table_name' => $model::tableName(),
            'table_id'   => $model->id
        ]);
        if (!empty($model)) {
            return $model->slug;
        } else {
            return '';
        }
    }

    /**
     * Search Slug Model
     * @param $model
     * @return string
     */
    public static function getSlugWithTableId($table, $id)
    {
        $model = self::findOne([
            'table_name' => $table,
            'table_id'   => $id
        ]);
        if (!empty($model)) {
            return $model->slug;
        } else {
            return '';
        }
    }

    public static function deleteSlug($model)
    {
        $model = self::findOne([
            'table_name' => $model::tableName(),
            'table_id'   => $model->id
        ]);
        if (!empty($model)) {
            return $model->delete();
        } else {
            return '';
        }
    }

    /**
     * load model From Slug
     * @param $slug
     * @return \YiiMan\YiiBasics\modules\slug\models\Slug|null
     */
    public static function loadSlug($slug)
    {
        return self::findOne(['slug' => $slug]);
    }

    /**
     * انواع اسلاگ و اکشن مربوطه را به سیستم اعلام میکند، تا در صورتی که صفحه ای با اسلاگ مربوطه یافت شد، سیستم مورد را به اکشن مربوطه ارجاع دهد
     * @param $array
     */
    public static function addSlugs($array)
    {
        self::$slugs = $array;
    }

    /**
     * همه ی اسلاگ هایی که توسط کانفیگ های سیستم اعلام شده اند را به صورت مپ شده بازگردانی میکند
     * @return array
     */
    public static function getAllSlugs()
    {
        self::loadSlugs();

        return self::$slugs;
    }

    private static function loadSlugs()
    {
        if (!self::$loaded) {
            $systemSlugs =
                [
                    [
                        'table'  => Pages::tableName(),
                        'action' => 'page',
                        'params' => ['id']
                    ],
                    [
                        'table'  => Menu::tableName(),
                        'action' => 'menu',
                        'params' => ['id']
                    ]
                ];
            self::$slugs = ArrayHelper::index(ArrayHelper::merge(self::$slugs, $systemSlugs), 'table');
            self::$loaded = true;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'slug',
                    'table_name',
                    'table_id'
                ],
                'required'
            ],
            [
                ['table_id'],
                'integer'
            ],
            [
                [
                    'slug',
                    'table_name'
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
            'id'         => Yii::t('slug', 'ID'),
            'slug'       => Yii::t('slug', 'نامک'),
            'table_name' => Yii::t('slug', 'Table Name'),
            'table_id'   => Yii::t('slug', 'Table ID'),
        ];
    }
}
