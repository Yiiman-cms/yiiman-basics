<?php


namespace YiiMan\YiiBasics\modules\location\models;


use YiiMan\YiiBasics\modules\posttypes\models\Posttypes;

class Stores extends Posttypes
{
    const STATUS_WAITING = 2;

    public static function getAllInCity($cityId,$limit=null)
    {
        $city = self::getPost('city', $cityId);
        $out= $city->getRelatedModels('store', false, true,$limit);
        return $out;
    }


}
