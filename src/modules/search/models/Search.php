<?php

namespace YiiMan\YiiBasics\modules\search\models;

use Yii;

/**
 * This is the model class for table "{{%module_search}}".
 *
 * @property int $id
 * @property string $query
 * @property int $resultCount
 * @property string $created_at
 * @property string $ip
 * @property string $result_types
 * @property string $lat
 * @property float $lng
 * @property string $device
 * @property string $country
 * @property string $city
 * @property string $operator
 * @property string $flag
 * @property string $browser
 */
class Search extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;
    public $hasLanguage = false;

    public static $configs = [];


    public static function addConfigs($array)
    {
        self::$configs = $array;
    }

    public static function getConfigs(){
        return self::$configs;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_search}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['query', 'resultCount', 'created_at', 'ip'], 'required'],
            [['resultCount'], 'integer'],
            [['created_at'], 'safe'],
            [['result_types','device','operator','city','country','browser'], 'string'],
            [['query'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('search', 'ID'),
            'query' => Yii::t('search', 'Query'),
            'resultCount' => Yii::t('search', 'Result Count'),
            'created_at' => Yii::t('search', 'Created At'),
            'ip' => Yii::t('search', 'Ip'),
            'result_types' => Yii::t('search', 'Result Types'),
        ];
    }
}
