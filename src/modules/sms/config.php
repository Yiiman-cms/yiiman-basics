<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\lib\Triggers;
use yii\base\Event;
use yii\web\Application;

$dir = basename(__DIR__);


$conf =
    [
        'name'      => $dir,
        'type'      => ['backend'],
        'namespace' => 'YiiMan\YiiBasics\modules\\'.$dir,
        'address'   => '',
        'menu'      =>

            [
                'name'  => $dir,
                'title' => 'Sms',
                'url'   => $dir.'/index'
            ]
        ,
    ];

// < اگر تنظیمات اختصاصی برای این ماژول میخواهید این بخش را تنظیم کنید >
{
    $viewAlias = '@system/modules/sms/settings';
    $settings =
        [
            [
                'id'       => 'smsPanel',
                'tabTitle' => Yii::t('sms', 'تنظیمات پیامک'),
            ]
        ];
}
// </ اگر تنظیمات اختصاصی برای این ماژول میخواهید این بخش را تنظیم کنید >


// < تغییری در این بخش ندهید - این بخش را برای همه ی ماژول هایی که نیاز به تنظیمات دارند کپی کنید >
{
    Event::on(Triggers::className(), Triggers::AFTER_SETTINGS_TAB, function () use ($settings) {
        foreach ($settings as $s) {
            echo '<li>
				<a href="#'.$s['id'].'" data-toggle="tab">'.$s['tabTitle'].'</a>
          </li>';
        }

    });
    Event::on(Triggers::className(), Triggers::AFTER_SETTINGS_TAB_CONTENT, function () use ($settings) {
        $model = \YiiMan\YiiBasics\modules\setting\models\DynamicModel::getInstans();
        $form = $model::getForm();
        foreach ($settings as $s) {
            echo '<div class="tab-pane" id="'.$s['id'].'">';
            (include __DIR__.'/settings/'.$s['id'].'.php');
            echo '</div>';
        }
    });
}
// </ تغییری در این بخش ندهید - این بخش را برای همه ی ماژول هایی که نیاز به تنظیمات دارند کپی کنید >

if (!defined('MTHJK_'.$dir)) {
    define('MTHJK_'.$dir, '1');
}
return $conf;
