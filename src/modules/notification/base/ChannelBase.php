<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\notification\base;


abstract class ChannelBase implements ChannelBaseInterface
{
    public $tokens = [];

    public function renderForm($form): string
    {
        return \Yii::$app->view->render('@system/modules/notification/settings/autorender.php',
            [
                'tokens' => $this->tokens,
                'form'   => $form
            ]
        );
    }

    public function renderJs(): string
    {
        return '';
    }
}