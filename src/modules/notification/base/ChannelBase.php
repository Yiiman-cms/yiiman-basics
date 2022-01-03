<?php


namespace YiiMan\YiiBasics\modules\notification\base;


abstract class ChannelBase implements ChannelBaseInterface
{
    public $tokens = [];

    public function renderForm($form): string
    {
        return \Yii::$app->view->render('@system/modules/notification/settings/autorender.php',
            [
                'tokens' => $this->tokens,
                'form'=> $form
            ]
        );
    }

    public function renderJs(): string
    {
        return '';
    }
}