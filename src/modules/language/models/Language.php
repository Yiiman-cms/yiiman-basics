<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\language\models;

use Yii;
use \YiiMan\YiiBasics\modules\menu\models\Menu;
use \YiiMan\YiiBasics\modules\pages\models\Pages;
use \YiiMan\YiiBasics\modules\profiles\models\Profiles;
use \YiiMan\YiiBasics\modules\seoflagcontents\models\SeoFlagContents;
use \YiiMan\YiiBasics\modules\seoflags\models\SeoFlags;
use \YiiMan\YiiBasics\modules\skills\models\Skills;
use \YiiMan\YiiBasics\modules\testimotional\models\Testimotional;
use \YiiMan\YiiBasics\modules\works\models\Works;
use \YiiMan\YiiBasics\modules\workscatworks\models\WorksCatWorks;

/**
 * This is the model class for table "{{%module_language}}".
 * @property int               $id
 * @property string            $title
 * @property string            $image
 * @property string            $code
 * @property string            $shortCode
 * @property int               $status
 * @property int               $default
 * @property string            $layout
 * @property string            $dateMode
 * @property Menu[]            $menus
 * @property Pages[]           $pages
 * @property Profiles[]        $profiles
 * @property SeoFlagContents[] $seoFlagContents
 * @property SeoFlags[]        $seoFlags
 * @property Skills[]          $skills
 * @property Testimotional[]   $testimotionals
 * @property Works[]           $works
 * @property WorksCatWorks[]   $worksCatWorks
 */
class Language extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_language}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'title',
                    'status',
                    'layout',
                    'shortCode'
                ],
                'required'
            ],
            [
                ['status'],
                'integer'
            ],
            [
                [
                    'title',
                    'code'
                ],
                'string',
                'max' => 50
            ],
            [
                ['image'],
                'string',
                'max' => 255
            ],
            [
                ['layout'],
                'string',
                'max' => 4
            ],
            [
                [
                    'shortCode',
                    'dateMode'
                ],
                'string',
                'max' => 10
            ],
            [
                ['default'],
                'integer'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'        => Yii::t('language', 'شناسه'),
            'shortCode' => Yii::t('language', 'کد کوتاه'),
            'title'     => Yii::t('language', 'موضوع'),
            'image'     => Yii::t('language', 'تصویر'),
            'code'      => Yii::t('language', 'کد'),
            'status'    => Yii::t('language', 'وضعیت'),
            'layout'    => Yii::t('language', 'ترتیب اسکلت'),
            'dateMode'  => Yii::t('language', 'سیستم تقویمی'),
        ];
    }

    public function attributeHints()
    {
        return
            [
                'shortCode' => Yii::t('language', 'کد زبان سیستمی')
            ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['language' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['language' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profiles::className(), ['language' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeoFlagContents()
    {
        return $this->hasMany(SeoFlagContents::className(), ['language' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeoFlags()
    {
        return $this->hasMany(SeoFlags::className(), ['language' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skills::className(), ['language' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestimotionals()
    {
        return $this->hasMany(Testimotional::className(), ['language' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Works::className(), ['language' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorksCatWorks()
    {
        return $this->hasMany(WorksCatWorks::className(), ['language' => 'id']);
    }

}
