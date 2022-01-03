<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 *
 * Site:https://yiiman.ir
 * Date: ۰۲/۲۵/۲۰۲۰
 * Time: ۱۷:۰۳ بعدازظهر
 */

namespace YiiMan\YiiBasics\modules\search\widgets;


use YiiMan\YiiBasics\modules\search\models\Search;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;

class HintWidget extends Widget
{
    public $days = 7;

    public function run()
    {
        $dates = [];
        $datesA = [];
        $dateLabel = [];
        for ($i = $this->days; $i > -1; $i--) {
            $dates[date('Y-m-d', strtotime('-' . $i . ' day'))] = date(
                'Y-m-d', strtotime('-' . $i . ' day'));
            $datesA[$i] = date('Y-m-d',strtotime('-' . $i . ' day'));

            // < Build Label >
            {
                $l1=date('Y-m-d', strtotime('-' . $i . ' day')
                );
                $l2=\Yii::$app->functions->convertdate($l1);
                $l2=explode('/',$l2);
                $l2=$l2[1].'-'.$l2[2];
            }
            // </ Build Label >

            $dateLabel[\Yii::$app->functions->convertdate(date('Y-m-d', strtotime('-' . $i . ' day')))] =$l2;

        }

        $model = Search::find()->select('COUNT(id) as count,created_at')->where(['between', 'created_at', $datesA[$this->days], $datesA[0]])->asArray()->all();

        $model = ArrayHelper::index($model, 'created_at');
        $m = ArrayHelper::getColumn($model, 'count');

//        $max = max($m);
        $max = 0;

        $dateArray = [];
        $dateLabels = [];
        foreach ($dates as $date) {

            $dateLabels[] = $dateLabel[\Yii::$app->functions->convertdate($date)];
            if (!empty($model[$date])) {

                $dateArray[] = $model[$date]['count'];

//					$dates[ $date ] = $model[ $date ]['count'];
            } else {
                $dateArray[] = 0;
            }
        }

        return $this->render(
            'index',
            [
                'dateArray' => json_encode($dateArray),
                'dateLabels' => json_encode($dateLabels),
                'max' => $max
            ]
        );

    }

}
