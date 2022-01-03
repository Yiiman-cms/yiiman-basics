<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2019
 * @package yii2-widgets
 * @subpackage yii2-widget-fileinput
 * @version 1.0.9
 */

namespace YiiMan\YiiBasics\modules\gallery\widgets;



use YiiMan\YiiBasics\lib\AssetBundle;

/**
 * BaseAsset is the base asset bundle class used by all FileInput widget asset bundles.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class VideoPlayerAsset extends AssetBundle {
    /**
     * @inheritdoc
     */
    public $sourcePath = '@system/modules/gallery/widgets/videoPlayer';
    public function __construct( $config = [] ) {

        $this->publishOptions =
            [
                'forceCopy' => YII_DEBUG ? true : false
            ];
        parent::__construct( $config );
    }

    public $css=
        [
            'video-js.css'
        ];
}
