<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

if (isset($_POST["fonts"]) && !empty($_POST["fonts"])) {
    $fontsFile = "../icons/icons.json";
    $fonts = $_POST["fonts"];

    if (file_exists($fontsFile)) {
        file_put_contents($fontsFile, $fonts);
        echo "success";
    }
}