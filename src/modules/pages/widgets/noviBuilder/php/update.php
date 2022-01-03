<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

$path = $_POST["path"];
$src = "../".$path.".novi/";
$dst = "../".$path."novi/";
if (file_exists($src)) {
    echo rename($src, $dst);
} else {
    echo true;
}