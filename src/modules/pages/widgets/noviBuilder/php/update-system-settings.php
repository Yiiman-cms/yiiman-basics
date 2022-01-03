<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

if (isset($_POST["config"]) && !empty($_POST["config"])) {
    $configFile = "../config/config.json";
    $config = $_POST["config"];

    if (file_exists($configFile)) {
        file_put_contents($configFile, $config);
        echo "success";
    }
}