<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\widgets\toggle\assets\SummernoteAssets;

/**
 * @var $label       string
 * @var $name        string
 * @var $description string
 * @var $value       string
 * @var $for         string
 */

?>

<div class="togglebutton col-sm-12">
    <label class="col-sm-12" style="color: rgba(0, 0, 0, 0.87)">
        <input <?php


        if (!empty($value)) {
            echo 'checked=""';
        }
        ?> type="checkbox" value="enable" class="col-md-12" id="<?= $for ?>"
           name="<?= $name ?>">
    </label>
    <span><?= $description ?></span>
</div>


