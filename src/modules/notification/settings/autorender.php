<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @var $model  \YiiMan\Setting\module\models\DynamicModel
 * @var $form   \yii\bootstrap\ActiveForm
 * @var $tokens []
 */

$model = new \YiiMan\Setting\module\models\DynamicModel();
$options = new \YiiMan\YiiBasics\modules\sms\base\smsOptions();
if (!empty($tokens)) {
    $count = 0;
    foreach ($tokens as $name => $label) {
        $attr = $name;

        if ($count == 0) {
            echo '<div class="row">';
        }
        echo '<div class="col-md-6">';
        $hint = false;
        if (is_array($label) && !empty($label['label'])) {
            $l = $label['label'];
        } else {
            $l = $label;
        }

        if (is_array($label) && !empty($label['hint'])) {
            $hint = $label['hint'];
        }

        //$model->addRule([$attr], 'required');
        $model->addRule([$attr], 'trim');
        $model->addRule([$attr], 'string', ['max' => 50]);
        $model->defineAttribute($attr);
        $model->{$attr} = $options->{$name};
        echo $form->field($model, $attr)->textInput()->hint($hint)->label($l);
        echo '</div>';
        if ($count == 0) {
            echo '</div>';
        }
        if ($count == 2) {
            $count = 0;
        }
        $count++;
    }
}

?>
