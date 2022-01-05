<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\pages\widgets\noviBuilder\assets;

use Yii;
use yii\web\AssetBundle;

class Assets extends \YiiMan\YiiBasics\lib\AssetBundle
{


    public $sourcePath = '@vendor/yiiman/yii-basics/src/modules/pages/widgets/noviBuilder/assets/files';

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
