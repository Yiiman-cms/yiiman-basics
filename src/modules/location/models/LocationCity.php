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
use Yii;
use \YiiMan\YiiBasics\modules\location\models\LocationNeighbourhood;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%module_location_city}}".
 * @property int                     $id
 * @property string                  $name
 * @property LocationNeighbourhood[] $locationNeighbourhoods0
 */
class LocationCity extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;
    /**
     * @var $cityModel self
     */
    public static $cityModel;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_location_city}}';
    }

    public static function getCityByID($id)
    {
        return self::findOne($id);
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
     * @return self|null
     */
    public static function getCity()
    {
        if (empty(self::$cityModel)) {
            if (!empty(\Yii::$app->cookie->city)) {
                return self::$cityModel = self::findOne(\Yii::$app->cookie->city);
            } else {
                if (!empty(\Yii::$app->Options->city)) {
                    return self::$cityModel = self::findOne(\Yii::$app->Options->city);
                } else {
                    self::$cityModel = self::find()->all();
                    if (!empty(self::$cityModel)) {
                        return self::$cityModel = self::$cityModel[0];
                    }
                }
            }
        } else {
            return self::$cityModel;
        }
    }

    /**
     * @return string
     */
    public static function getAllCities_htmlOption($checkedId = '', bool $hasAllTag = true, int $limit = 0)
    {
        if ($hasAllTag) {
            $html = '<option value="">همه شهرها</option>';
        } else {
            $html = '';
        }
        $cities = self::getAllCitiesMapped($limit);
        if (!empty($cities)) {
            foreach ($cities as $id => $title) {
                $checked = '';
                if (empty($cId)) {
                    $cId = $id;
                } else {
                    $cId = $checkedId;
                }
                if (($city = (int) $id) == (int) $cId) {
                    $checked = 'selected';
                }
                $html .= '<option value="'.$id.'" '.$checked.'>'.$title.'</option>';
            }
        }
        return $html;
    }

    /**
     * @return array
     */
    public static function getAllCitiesMapped(int $limit)
    {
        $cities = self::getAllCities($limit);
        if (!empty($cities)) {
            return ArrayHelper::map($cities, 'id', 'name');
        } else {
            return [];
        }
    }

    /**
     * @return Posttypes[]|null
     */
    public static function getAllCities(int $limit = 0)
    {
        $out = self::find();
        if (!empty($limit)) {
            $out = $out->limit($limit);
        }
        return $out->all();
    }

    /**
     * @return string
     */
    public static function getCityTitle()
    {
        if (!empty(self::getCity())) {
            return self::getCity()->name;
        } else {
            return '';
        }
    }

    /**
     * @param $id
     */
    public static function setCity($id)
    {
        $city = self::findOne($id);
        if (!empty($city)) {
            \Yii::$app->cookie->city = $id;
            self::$cityModel = $city;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['name'],
                'required'
            ],
            [
                ['name'],
                'string',
                'max' => 255
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'   => Yii::t('location', 'ID'),
            'name' => Yii::t('location', 'نام شهر'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationNeighbourhoods0()
    {
        return $this->hasMany(LocationNeighbourhood::className(), ['city' => 'id']);
    }
}
