<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @var $dateLabels
 * @var $dateArray
 * @var $max
 */
$js = <<<JS
dataRoundedLineChart =
{
	labels:
	$dateLabels,
	series:
	 [
	    $dateArray
	 ]
};

            optionsRoundedLineChart =
            {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 10
                }),
                axisX:
                {
				    labelInterpolationFnc:
				     function(value)
				    {
				      return  value;
				    }
                },
                low: 0,
                high: $max , // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
                showPoint: false
            };

            var RoundedLineChart = new Chartist.Line('#roundedLineChart', dataRoundedLineChart, optionsRoundedLineChart);

            md.startAnimationForLineChart(RoundedLineChart);

JS;
$this->registerJs($js, $this::POS_END);
?>

<div class="card card-chart">
    <div class="card-header card-header-rose">
        <div id="roundedLineChart" class="ct-chart"></div>
    </div>
    <div class="card-body">
        <h4 class="card-title"><?= \Yii::t('hint', 'آمار کلی بازدید های سایت') ?></h4>
    </div>
</div>
