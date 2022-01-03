<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

if (isset($_POST['path']) && isset($_POST['content'])) {
    $url = "../".$_POST['path'];

    if (!file_exists($url)) {
        echo "false";
    }


    if (!file_put_contents($url, $_POST['content'])) {
        echo "false";
    }

    echo "true";
}









