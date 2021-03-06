<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\Alertjs;

use YiiMan\YiiBasics\lib\i18n\Layout;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use \YiiMan\YiiBasics\lib\AssetBundle;

/**
 * Froala Editor asset
 */
class AlertJsAssets extends AssetBundle
{
    public static $theme = 'bootstrap';
    /**
     * @var array
     */
    public $js = [
        'alertify.min.js',
    ];
    /**
     * @var array
     */
    public $css = [
        'css/alertify.css',
    ];
    /**
     * @var array
     */
    public $depends = [
//        '\yii\web\JqueryAsset',
    ];

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if (Layout::run() == 'rtl') {
            $this->css[] = 'css/alertify.rtl.css';
            self::$theme = self::$theme.'.rtl';
        }

        $this->css[] = 'css/themes/'.self::$theme.'.css';
        $this->sourcePath = realpath(__DIR__.'/files');
    }


}
