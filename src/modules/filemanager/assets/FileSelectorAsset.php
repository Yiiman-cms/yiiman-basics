<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\filemanager\assets;

use YiiMan\YiiBasics\lib\View;
use yii\web\AssetBundle;

/**
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:http://yiiman.ir
 * Date: 12/29/2018
 * Time: 2:43 PM
 */
class FileSelectorAsset extends AssetBundle
{

    public $jsOptions = ['position' => View::POS_HEAD];
    public $depends =
        [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
        ];

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->sourcePath = realpath(__DIR__.'/files/widgets');
    }

}
