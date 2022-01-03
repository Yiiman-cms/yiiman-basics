<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

$pluginsDir = "../plugins/";
if (!file_exists($pluginsDir)) {
    mkdir($pluginsDir);
}

$plugins = glob($pluginsDir."*");
for ($i = 0; $i < count($plugins); $i++) {
    $plugins[$i] = substr($plugins[$i], 3);
}
echo json_encode($plugins);

