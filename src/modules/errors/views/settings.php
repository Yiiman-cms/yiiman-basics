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
 * Date: 12/15/2018
 * Time: 1:23 AM
 */

use YiiMan\Setting\widgets\FieldRender;
use YiiMan\Setting\widgets\ImageSelectWidget;
use YiiMan\YiiBasics\modules\errors\themes\one\assets\ErrorAsset;

?>

<div class="card" style="margin-top: 20px">
    <h3>تنظیمات صفحه ی خطا</h3>
    <?php
    $themeFolders = getFileList(__DIR__.'/../themes');
    $themes = [];
    /* < Check if Asset Folder Is Not Exist > */
    {
        if (!realpath($_ENV['uploadDir'].'/assets/error-themes/')) {
            mkdir($_ENV['uploadDir'].'/assets/error-themes/', 0777, true);
        }
    }
    /* </ Check if Asset Folder Is Not Exist > */
    $is=[];
    foreach ($themeFolders as $theme) {
        $item = [];

        Yii::$app->urlManager->showScriptName = false;
        $assetClass = 'YiiMan\YiiBasics\modules\errors\themes\\'.$theme['name'].'\assets\ErrorAsset';
        if (!realpath($_ENV['uploadDir'].'/errorcovers/'.$theme['name'].'/cover.png')) {
            @mkdir($_ENV['uploadDir'].'/errorcovers/'.$theme['name'], 0777, true);
            copy(__DIR__.'/../themes/'.$theme['name'].'/cover.png',
                $_ENV['uploadDir'].'/errorcovers/'.$theme['name'].'/cover.png');
        }
        $item['img'] = $_ENV['uploadURL'].'/errorcovers/'.$theme['name'].'/cover.png';
        $item['value'] = $theme['name'];
        $themes[] = $item;

        $is[$item['img']]= $item['value'];
    }
    echo $form->field($model, 'errorTheme')->widget(
        ImageSelectWidget::className(),
        [
            'images' => $is
        ]
    )
        ->label(Yii::t('settings', 'انتخاب قالب نمایش خطا به کاربران'))->hint(
            Yii::t(
                'settings',
                'انتخاب کنید تمایل دارید کدام قالب برای نمایش خطا به کاربران نمایش داده شود؟'
            )
        );

?>
</div>
