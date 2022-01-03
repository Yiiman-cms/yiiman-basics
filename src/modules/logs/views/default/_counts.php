<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @var \yii\web\View                 $this
 * @var \zhuravljov\yii\logreader\Log $log
 */

use yii\helpers\Html;

/** @var \zhuravljov\yii\logreader\Module $module */
$module = $this->context->module;

foreach ($log->getCounts() as $level => $count) {
    if (isset($module->levelClasses[$level])) {
        $class = $module->levelClasses[$level];
    } else {
        $class = $module->defaultLevelClass;
    }
    echo Html::tag('span', $count, [
        'class' => 'label '.$class,
        'title' => $level,
    ]);
    echo ' ';
}