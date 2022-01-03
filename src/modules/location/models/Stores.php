<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\location\models;


use YiiMan\YiiBasics\modules\posttypes\models\Posttypes;

class Stores extends Posttypes
{
    const STATUS_WAITING = 2;

    public static function getAllInCity($cityId, $limit = null)
    {
        $city = self::getPost('city', $cityId);
        $out = $city->getRelatedModels('store', false, true, $limit);
        return $out;
    }


}
