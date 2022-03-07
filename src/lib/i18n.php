<?php
/**
 * Copyright (c) 2008-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * I18N provides features related with internationalization (I18N) and localization (L10N).
 * I18N is configured as an application component in [[\yii\base\Application]] by default.
 * You can access that instance via `Yii::$app->i18n`.
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @property MessageFormatter $messageFormatter The message formatter to be used to format message via ICU
 * message format. Note that the type of this property differs in getter and setter. See
 * [[getMessageFormatter()]] and [[setMessageFormatter()]] for details.
 * @since  2.0
 */
class i18n extends \YiiMan\YiiBasics\lib\i18n\I18N
{

}
