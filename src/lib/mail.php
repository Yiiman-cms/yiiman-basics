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
 * Date: 03/26/2020
 * Time: 20:06 PM
 */

namespace YiiMan\YiiBasics\lib;


use YiiMan\YiiBasics\lib\mail\Mailer;
use Yii;

class mail extends Mailer
{
    public function __construct($config = [])
    {
        $this->useFileTransport = false;
        $this->transport =
            [
                'class'      => 'Swift_SmtpTransport',
                'encryption' => 'tls',
                'host'       => Yii::$app->Options->emailServer,
                'port'       => Yii::$app->Options->emailPort,
                'username'   => Yii::$app->Options->emailUsername,
                'password'   => Yii::$app->Options->emailPassword,
            ];
        parent::__construct($config);

    }
}
