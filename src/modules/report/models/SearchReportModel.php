<?php


namespace YiiMan\YiiBasics\modules\report\models;

use phpDocumentor\Reflection\Types\This;
use YiiMan\YiiBasics\lib\ActiveRecord;
use YiiMan\YiiBasics\modules\medicard\models\Medicard;
use YiiMan\YiiBasics\modules\report\controllers\BaseReportController;
use YiiMan\YiiBasics\modules\report\validator\Base;
use yii\base\Behavior;
use yii\base\InvalidCallException;
use yii\base\InvalidParamException;
use yii\base\UnknownPropertyException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecordInterface;

/**
 * Class SearchReportModel
 * @package YiiMan\YiiBasics\modules\report\models
 * @property ActiveRecord $modelClass
 */
class SearchReportModel extends \yii\db\ActiveRecord
{
    public static $modelClass;
    public static $labels;
    public static $attributes;
    public static $extraRules = [];


    public $attrs = [];

    public static function tableName()
    {
        $cname = self::$modelClass;
        $model = new $cname();
        return $model::tableName();
    }

    public function rules()
    {

        $cname = self::$modelClass;
        $model = new $cname();
        /**
         * @var $model ActiveRecord
         */

        $out = [[array_keys($model->attributes), 'safe']];
        return array_merge_recursive($out, self::$extraRules);
    }

    public function attributeLabels()
    {
        $labels = self::$labels;
        return $labels;
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param BaseReportController $controller
     *
     * @return ActiveDataProvider
     */
    public function search($params, $controller)
    {
        $query = $this::$modelClass::find();

        /**
         * @var $query ActiveRecord
         */

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        // < load custom _search attributes >
        {
            if (!empty($this->attrs)) {
                foreach ($this->attrs as $attr) {
                    $this->attrs[$attr]=$this->filterVal($attr);
                }
            }
        }
        // </ load custom _search attributes >

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $customFilters = $controller->filterParse($query, $this);
        $customFilters = array_flip($customFilters);

        $filters = [];
        foreach (self::$attributes as $attr => $val) {
            if (!empty($params['SearchReportModel'][$attr])) {
                if (!isset($customFilters[$attr])) {
                    $filters[$attr] = ['like', $attr, $params['SearchReportModel'][$attr]];
                }
                $this->{$attr} = $params['SearchReportModel'][$attr];
            }
        }

        // grid filtering conditions
        $query->andFilterWhere($filters);


//        $query->andFilterWhere(['like', 'name', $this->name])
//            ->andFilterWhere(['like', 'level', $this->level]);

        return $dataProvider;
    }

    /**
     * بررسی میکند آیا فیلتر نام برده شده ارسال شده است یا خیر
     * @param $filterName
     * @return bool
     */
    public function hasFilter($filterName)
    {
        $get = \Yii::$app->request->get();
        if (!empty($get['SearchReportModel'][$filterName])) {
            return true;
        } else {
            if (!empty($get['SearchReportModel']['attrs']) && !empty($get['SearchReportModel']['attrs'][$filterName])) {
                return true;
            }
            return false;
        }
    }

    /**
     * در صورتی که فیلتر نام برده شده از طرف کلاینت ارسال شده باشد, مقدار آن را بازگردانی میکند
     * @param $filterName
     * @return mixed|null
     */
    public function filterVal($filterName)
    {
        $get = \Yii::$app->request->get();
        if ($this->hasFilter($filterName)) {
            if (!empty($get['SearchReportModel'][$filterName])) {
                return $get['SearchReportModel'][$filterName];
            }

            if (!empty($get['SearchReportModel']['attrs']) && !empty($get['SearchReportModel']['attrs'][$filterName])) {
                return $get['SearchReportModel']['attrs'][$filterName];
            }
            return null;
        } else {
            return null;
        }
    }


    /**
     * PHP setter magic method.
     * This method is overridden so that AR attributes can be accessed like properties.
     * @param string $name property name
     * @param mixed $value property value
     */
    public function __set($name, $value)
    {
        try {
            parent::__set($name,$value);
        }catch (\Exception $e){
            $this->{$name}=$value;
        }
    }

}