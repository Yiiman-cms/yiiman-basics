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
 * Date: 1/23/2019
 * Time: 7:10 AM
 */

namespace YiiMan\YiiBasics\modules\seo\components;

use YiiMan\YiiBasics\lib\Object1;
use YiiMan\YiiBasics\modules\seo\models\SeoFlags;
use Yii;
use yii\bootstrap\BootstrapAsset;
use yii\helpers\ArrayHelper;

class seo extends Object1
{
    public $flags;

    public function textFlags($text)
    {
        $view = Yii::$app->view;
        $view->registerJs($view->render('@vendor/yiiman/yii-basics/src/modules/seo/assets/files/js/tippy.js'), $view::POS_END);
        $view->registerJs('$(document).ready(function(){$.protip({scheme:"dark"});});', $view::POS_END);
        $view->registerCss($view->render('@vendor/yiiman/yii-basics/src/modules/seo/assets/files/css/protip.css'));
        if (empty($flags)) {
            $model = SeoFlags::find()->all();
            $this->flags = $model;
        }

        foreach ($this->flags as $flag) {
            /**
             * @var $flag SeoFlags
             */
            $content = $flag->content0;
            $shortContent = $content->short_content;


            $title = $flag->flag;


            $html = <<<HTML
			
<a href="#bar" title="$title" data-pt-animate="bounceIn" data-pt-title='$shortContent' class="protip">$title</a>

HTML;

            $text = str_replace($title, $html, $text);
        }
        return $text;
    }

}
