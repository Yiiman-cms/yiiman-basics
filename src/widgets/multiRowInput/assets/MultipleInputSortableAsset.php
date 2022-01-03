<?php

/**
 * @link https://github.com/unclead/yii2-multiple-input
 * @copyright Copyright (c) 2014 unclead
 * @license https://github.com/unclead/yii2-multiple-input/blob/master/LICENSE.md
 */

namespace YiiMan\YiiBasics\widgets\multiRowInput\assets;

use yii\web\AssetBundle;

/**
 * Class MultipleInputAsset
 * @package YiiMan\YiiBasics\widgets\multiRowInput\assets
 */
class MultipleInputSortableAsset extends AssetBundle
{
    public $depends = [
        'YiiMan\YiiBasics\widgets\multiRowInput\assets\MultipleInputAsset',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/src/';

        $this->js = [
            YII_DEBUG ? 'js/jquery-sortable.js' : 'js/jquery-sortable.min.js'
        ];

        $this->css = [
            YII_DEBUG ? 'css/sorting.css' : 'css/sorting.min.css'
        ];

        parent::init();
    }
} 
