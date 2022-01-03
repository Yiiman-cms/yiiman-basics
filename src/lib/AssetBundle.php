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
 * Date: 30/04/2019
 * Time: 04:28 PM
 */

namespace YiiMan\YiiBasics\lib;


use Yii;
use function define;
use function defined;

/**
 * این کلاس ورژن بندی است ها ها را برای زمانی که سیستم را در حالت دیباگ قرار می دهید، و فایل های استایل را تغییر می دهید مفید است.
 * Class AssetBundle
 * @package YiiMan\YiiBasics\lib
 */
class AssetBundle extends \yii\web\AssetBundle
{
    public function __construct($config = [])
    {

        Yii::$app->Develop->changeAssetsVersion($this->css, $this->js);
        $this->publishOptions =
            [
                'forceCopy' => YII_DEBUG ? true : false
            ];
        parent::__construct($config);
    }

    public function registerAssetFiles($view)
    {
        $className = (new \ReflectionClass($this))->getShortName();

        if (!defined($className)) {
            define($className, 'ok');
        } else {
            return;
        }
        parent::registerAssetFiles($view); // TODO: Change the autogenerated stub
    }

}
