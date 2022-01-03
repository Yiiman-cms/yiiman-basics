<?php

namespace YiiMan\YiiBasics\modules\hint\models;

use Yii;

/**
 * This is the model class for table "{{%module_hint}}".
 *
 * @property int $id
 * @property string $date
 * @property int $count
 * @property int $table_id
 * @property string $url
 * @property string $table
 */
class Hint extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    private static $configs = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_hint}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['date'], 'safe'],
            [['count', 'table_id'], 'integer'],
            [['url', 'table'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('hint', 'شناسه'),
            'date' => Yii::t('hint', 'تاریخ'),
            'count' => Yii::t('hint', 'تعداد'),
            'url' => Yii::t('hint', 'لینک'),
        ];
    }

    public static function configHint($array)
    {
        self::$configs = $array;
    }


    /**
     * @param $controller
     * @return bool|mixed
     */
    public static function getConfig($controller)
    {
        if (!empty(self::$configs[$controller])) {
            return self::$configs[$controller];
        } else {
            return false;
        }
    }

    /**
     * @param $tableName
     * @param $tableId
     */
    public static function hint($tableName, $tableId)
    {
        $model = self::findOne(['table' => $tableName, 'table_id' => $tableId, 'date' => date('Y-m-d')]);
        if (!empty($model)) {
            $model->count = $model->count + 1;
            $model->save();
        } else {
            $model = new Hint();
            $model->date = date('Y-m-d');
            $model->count = 1;
            $model->table = $tableName;
            $model->table_id = $tableId;
            $model->save();
        }
    }

    /**
     * @param $tableName
     * @param $tableId
     * @return int
     */
    public static function getHint($tableName, $tableId)
    {
        $hint = Hint::findOne(['table' => $tableName, 'table_id' => $tableId]);
        if (!empty($hint)) {
            return $hint->count;
        } else {
            return 0;
        }
    }
}
