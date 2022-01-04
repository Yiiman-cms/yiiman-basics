<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib;

use phpDocumentor\Reflection\Types\Integer;
use \Yii;
use yii\helpers\ArrayHelper;

class Language
{
    private static $languages = [];
    private static $currentId = null;

    /**
     * زبان سیستم را برای فرانت اند تغییر می دهد
     * @param  null|string  $language  Language Short Code
     * @return string Language Shortcode
     */
    public static function changeLanguage($language = null)
    {
        $AllLanguages = (new self())->getLanguages();
        if (empty($language)) {
            $language = Yii::$app->cookie->language;
        }
        if (empty($language)) {
            $AllLanguages = ArrayHelper::index(ArrayHelper::toArray($AllLanguages), 'default');

            $lngModel = (object) $AllLanguages[1];
            Yii::$app->cookie->language = $lngModel->shortCode;
            $language = $lngModel->shortCode;
        } else {
            if (!empty($AllLanguages[$language])) {
                $lngModel = $AllLanguages[$language];
                Yii::$app->cookie->language = $language;
            } else {
                $AllLanguages = ArrayHelper::index(ArrayHelper::toArray($AllLanguages), 'default');

                $lngModel = (object) $AllLanguages[1];
                Yii::$app->cookie->language = $lngModel->shortCode;
                $language = $lngModel->shortCode;
            }
        }
        if (!defined('LNGID')) {
            define('LNGID', $lngModel->id);
        } else {
            define('LNGID2', $lngModel->id);
        }
        return $language;
    }

    /**
     * @return object
     */
    public function currentLanguageObject()
    {
        $languages = ArrayHelper::index($this->getLanguages(), 'id');
        return $languages[$this->currentID()];
    }

    /**
     * @return array array of objects
     */
    public function getLanguages()
    {
        if (empty(self::$languages)) {
            if (realpath(Yii::getAlias('@system').'/languages.json')) {
                self::$languages = (array) json_decode(file_get_contents(Yii::getAlias('@system').'/languages.json'));
            } else {
                (new self())->reBuild();
                self::$languages = (array) json_decode(file_get_contents(Yii::getAlias('@system').'/languages.json'));
            }
        }
        return self::$languages;
    }

    /**
     * فایل کش زبان ها رو مجددا میسازد
     */
    public function reBuild()
    {
        $file = Yii::getAlias('@system').'/languages.json';
        $languages = \YiiMan\YiiBasics\modules\language\models\Language::find()->where(['status' => \YiiMan\YiiBasics\modules\language\models\Language::STATUS_ACTIVE])->all();
        $array = [];
        foreach ($languages as $item) {
            /**
             * @var $item \YiiMan\YiiBasics\modules\language\models\Language
             */
            $ar = [];
            $ar['title'] = $item->title;
            $ar['id'] = $item->id;
            $ar['image'] = $item->image;
            $ar['layout'] = $item->layout;
            $ar['code'] = $item->code;
            $ar['shortCode'] = $item->shortCode;
            $ar['default'] = $item->default;
            $ar['dateMode'] = $item->dateMode;


            $code = explode('-', $ar['code']);
            $code1 = strtolower($code[0]);
            $code2 = strtoupper($code[1]);
            $ar['systemCode'] = $code1.'-'.$code2;


            $array[$item->shortCode] = $ar;

        }
        file_put_contents($file, json_encode($array));
    }

    /**
     * Return Current System Language Id
     * @return Integer|null
     */
    public function currentID()
    {
        if (empty(self::$currentId)) {

            self::$currentId = LNGID;
        }
        if (defined('LNGID2')) {
            self::$currentId = LNGID2;
        }
        return self::$currentId;
    }

    /**
     * Return Current Viewing page content language, for example if not set $_GET[lng] will return system language
     * but if set $_GET[lng] will rerurn Geted Language ID
     * @return mixed|Integer|null
     */
    public function contentLanguageID()
    {
        $languageID = $this->currentID();
        if (!empty($_GET['lng'])) {
            $languageID = $_GET['lng'];
        }
        return $languageID;
    }

    public function defaultLanguageID()
    {
        return $this->defaultLanguage()->id;
    }

    public function defaultLanguage()
    {
        foreach (self::getLanguages() as $lng) {
            if (!empty($lng->default)) {
                return $lng;
            }
        }
    }
}
