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
 * Date: 12/29/2018
 * Time: 3:19 PM
 */

/**
 * @var $this \yii\web\View
 */

use YiiMan\YiiBasics\lib\View;
use YiiMan\YiiBasics\modules\filemanager\assets\FileManagerAsset;

FileManagerAsset::register($this);
$path = str_replace('\\', '/', Yii::$app->Options->UploadDir);


$this->registerJs($this->render('app.js', ['path' => $path]), View::POS_HEAD);


?>
<div class="container" data-ng-app="FileManagerApp">
    <angular-filemanager></angular-filemanager>
</div>
