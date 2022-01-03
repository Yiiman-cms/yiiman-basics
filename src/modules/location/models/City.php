<?php


namespace YiiMan\YiiBasics\modules\location\models;


use YiiMan\YiiBasics\lib\ActiveRecord;
use YiiMan\YiiBasics\modules\posttypes\models\Posttypes;
use yii\helpers\ArrayHelper;

/**
 * Class City
 * @package modules\location\models
 * @property-read Posttypes $cityModel
 *
 */
class City extends Posttypes
{
    /**
     * @var $cityModel Posttypes
     */
    public static $cityModel;

    /**
     * @return Posttypes|null
     */
    public static function getCity()
    {
        if (empty(self::$cityModel)) {
            if (!empty(\Yii::$app->cookie->city)) {
                return self::$cityModel = self::getPost('', \Yii::$app->cookie->city);
            } else {
                if (!empty(\Yii::$app->Options->city)) {
                    return self::$cityModel = self::getPost('', \Yii::$app->Options->city);
                } else {
                    self::$cityModel = self::getPosts('city');
                    if (!empty(self::$cityModel)) {
                        return self::$cityModel = self::$cityModel[0];
                    }
                }
            }
        } else {
            return self::$cityModel;
        }
    }

    public static function getCityByID($id)
    {
        return self::getPost('city', $id);
    }

    /**
     * @return int|null
     */
    public static function getCityId()
    {
        if (!empty(self::getCity())) {
            return self::getCity()->id;
        } else {
            return null;
        }
    }

    /**
     * @return Posttypes[]|null
     */
    public static function getAllCities()
    {
        return self::getPosts('city');
    }

    /**
     * @return array
     */
    public static function getAllCitiesMapped()
    {
        $cities = self::getAllCities();
        if (!empty($cities)) {
            return ArrayHelper::map($cities, 'id', 'title');
        } else {
            return [];
        }
    }

    /**
     * @return string
     */
    public static function getAllCities_htmlOption($checkedId = '',$hasAllTag=true)
    {
        if ($hasAllTag){
            $html = '<option value="">همه شهرها</option>';
        }else{
            $html='';
        }
        $cities = self::getAllCitiesMapped();
        if (!empty($cities)) {
            foreach ($cities as $id => $title) {
                $checked = '';
                if (empty($cId)) {
                    $cId = $id;
                } else {
                    $cId = $checkedId;
                }
                if ((int)self::getCityId() == (int)$cId) {
                    $checked = 'selected';
                }
                $html .= '<option value="' . $id . '" ' . $checked . '>' . $title . '</option>';
            }
        }
        return $html;
    }

    /**
     * @return string
     */
    public static function getCityTitle()
    {
        if (!empty(self::getCity())) {
            return self::getCity()->title;
        } else {
            return '';
        }
    }

    /**
     * @param $id
     */
    public static function setCity($id)
    {
        $city = Posttypes::getPost($id);
        if (!empty($city)) {
            \Yii::$app->cookie->city = $id;
            self::$cityModel = $city;
        }
    }
}
