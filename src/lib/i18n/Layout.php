<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: 03/22/2020
 * Time: 17:13 PM
 */

namespace YiiMan\YiiBasics\lib\i18n;


use YiiMan\YiiBasics\modules\language\models\Language;
use Yii;
use function file_get_contents;
use function json_decode;

class Layout
{
    public static $layout = '';
    public static $LanguageModel;

    public static function run()
    {
        if (!empty(self::$layout)) {
            return self::$layout;
        }


        if (empty(self::$LanguageModel)) {
            $model = Language::findOne(['shortCode' => Yii::$app->language]);
            if (!empty($model)) {
                self::$LanguageModel = $model;
                self::$layout = $model->layout;
                return $model->layout;
            }
        }


        return 'rtl';
    }

    public static function date()
    {
        if (!empty(self::$layout)) {
            return self::$layout;
        }
        $content = file_get_contents(__DIR__.'/date.json');
        $content = json_decode($content);
        try {
            $content = $content->{Yii::$app->language};
        } catch (\Exception $e) {
            $lng = Yii::$app->Language->currentLanguageObject()->systemCode;
            $content = $content->{$lng};
        }
        self::$layout = $content;

        return $content;
    }


}
