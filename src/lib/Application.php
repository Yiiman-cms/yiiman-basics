<?php
/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:09353466620
 * Company Phone:05138846411
 * Site:https://yiiman.ir
 * Date: ۰۳/۰۵/۲۰۲۰
 * Time: ۱۹:۳۲ بعدازظهر
 */

namespace YiiMan\YiiBasics\lib;

use yii\web\ErrorHandler;
use yii\web\Request;
use yii\web\Response;
use yii\web\Session;
use yii\web\User;

/**
 * Application is the base class for all web application classes.
 *
 * For more details and usage information on Application, see the [guide article on
 * applications](guide:structure-applications).
 *
 * @property ErrorHandler $errorHandler            The error handler application
 *           component. This property is read-only.
 * @property string $homeUrl                 The homepage URL.
 * @property \DigitalOceanV2\DigitalOceanV2 $DigitalOceanV2          The homepage URL.
 * @property Request $request                 The request component. This property
 *           is read-only.
 * @property Response $response                The response component. This property
 *           is read-only.
 * @property Session $session                 The session component. This property
 *           is read-only.
 * @property \YiiMan\YiiBasics\modules\useradmin\models\User $user                    The user component. This property is
 *           read-only.
 * @property Language $Language                    The user component. This property is
 *           read-only.
 *
 * @property \YiiMan\YiiBasics\lib\Telegram $Telegram                The user component. This property is
 *           read-only.
 * @property \YiiMan\YiiBasics\lib\Hook $Hook                    The user component. This property is
 *           read-only.
 * @property \YiiMan\YiiBasics\lib\sms $sms                     The user component. This property is
 *           read-only.
 * @property \YiiMan\YiiBasics\lib\payir $payir                   The user component. This property is
 *           read-only.
 *S @property \YiiMan\Setting\module\components\Options $Options تنظیمات سایت از این کلاس
 *                       فراخوانی می شود
 * @property \YiiMan\YiiBasics\lib\functions $functions               The user component. This property is
 *           read-only.
 * @property \YiiMan\YiiBasics\modules\seo\components\seo $seo                     The user component. This property is
 *           read-only.
 * @property frontNav $frontNav                The user component. This property is
 *           read-only.
 * @property \YiiMan\YiiBasics\lib\Zarinpal $Zarinpal
 * @property \YiiMan\YiiBasics\lib\ssh $ssh
 * @property \YiiMan\YiiBasics\lib\sftp $sftp
 * @property \YiiMan\YiiBasics\lib\cookie $cookie
 * @property \YiiMan\YiiBasics\lib\DB $DB
 * @property \YiiMan\YiiBasics\lib\arvanApi $arvanApi
 * @property \YiiMan\YiiBasics\lib\ArzPrice $ArzPrice
 * @property \YiiMan\YiiBasics\lib\CloudFlare $CloudFlare
 * @property \YiiMan\YiiBasics\lib\Triggers $Triggers
 * @property \YiiMan\YiiBasics\lib\Develop $Develop
 * @property \YiiMan\YiiBasics\lib\authManager $authManager
 * @property \YiiMan\YiiBasics\lib\AssetBundle $AssetBundle
 * @property \yii\web\UrlManager $urlManager
 * @property \YiiMan\YiiBasics\lib\mail $mail
 * @property \YiiMan\YiiBasics\lib\DeviceDetector $DeviceDetector
 * @property \YiiMan\YiiBasics\lib\UploadManager $UploadManager
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since  2.0
 */
class Application extends \yii\web\Application
{

}
