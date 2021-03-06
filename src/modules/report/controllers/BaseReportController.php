<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\report\controllers;

use phpDocumentor\Reflection\Types\This;
use phpDocumentor\Reflection\Types\True_;
use YiiMan\YiiBasics\lib\ActiveRecord;
use YiiMan\YiiBasics\modules\report\models\SearchReportModel;
use YiiMan\YiiBasics\modules\report\views\View;
use YiiMan\YiiBasics\modules\service\models\Service;

/**
 * Class BaseReportController
 * @package YiiMan\YiiBasics\modules\report\controllers
 * @property ActiveRecord $modelClass
 * @property View         $viewClass
 */
class BaseReportController extends \YiiMan\YiiBasics\lib\Controller implements View
{
    public $modelClass;

    public function actionIndex()
    {
        $searchModel = new SearchReportModel();
        $searchModel::$modelClass = $this->modelClass;
        $searchModel::$labels = $this->AttributeLabels();
        $searchModel->attrs = $this->publicAttrs();
        $searchModel::$attributes = (new $this->modelClass)->attributes;
        $searchModel::$extraRules = $this->rules();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams, $this);


        return $this->render('@vendor/yiiman/yii-basics/src/modules/report/views/index.php',
            [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
                'view'         => $this,
                'viewname'     => $this->id
            ]
        );
    }

    public function AttributeLabels()
    {
        return (new $this->modelClass)->attributeLabels();
    }

    public function publicAttrs()
    {
        return [];
    }

    public function rules()
    {
        return [];
    }

    public function columns()
    {
        return [];
    }

    public function searchFields($form)
    {
        // TODO: Implement searchFields() method.
    }

    public function reportTitle()
    {
        return 'گزارش تست';
    }

    public function IndexButtons()
    {
        return '{view}';
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

    public function filterParse(&$query, &$model)
    {
        // TODO: Implement filterParse() method.
    }

    public function mapFields($model, $attr)
    {
        $mapArray = [];
        if (!empty($model)) {
            foreach ($model as $m) {
                $mapArray[] = $m->{$attr};
            }
        }
        return $mapArray;
    }
}