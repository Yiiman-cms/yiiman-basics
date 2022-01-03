<?php

namespace YiiMan\YiiBasics\widgets\mapInput;

use Yii;

/**
 * Class GMapInputWidget
 * @package YiiMan\YiiBasics\widgets\mapInput
 *
 */
class GMapInputWidget extends \yii\widgets\InputWidget
{

    public $key;

    public $latitude = 0;

    public $longitude = 0;

    public $zoom = 0;

    public $width = '100%';

    public $height = '300px';

    public $pattern = '(%latitude%,%longitude%)';

    public $mapType = 'roadmap';

    public $animateMarker = false;

    public $alignMapCenter = true;

    public $enableSearchBar = true;

    public function run()
    {

        Yii::setAlias('@systemMap','@system/widgets/mapInput');

        // Asset bundle should be configured with the application key
        $this->configureAssetBundle();

        return $this->render(
            'MapInputWidget',
            [
                'id' => $this->getId(),
                'model' => $this->model,
                'attribute' => $this->attribute,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'zoom' => $this->zoom,
                'width' => $this->width,
                'height' => $this->height,
                'pattern' => $this->pattern,
                'mapType' => $this->mapType,
                'animateMarker' => $this->animateMarker,
                'alignMapCenter' => $this->alignMapCenter,
                'enableSearchBar' => $this->enableSearchBar,
            ]
        );
    }

    private function configureAssetBundle()
    {
	    \YiiMan\YiiBasics\widgets\mapInput\assets\MapInputAsset::$key = $this->key;
    }
}
