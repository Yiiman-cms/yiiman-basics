<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

$uploadDir = 'novi/pages/';
$result = [];

if (isset($_POST["url"]) && isset($_POST["dir"]) && !empty($_POST["url"])) {
    $projectName = $_POST["dir"];
    $url = $_POST["url"];

    if ($url == "null") {
        echo json_encode(null);
        exit();
    }

    $projectUrl = "../".$projectName;

    if (!file_exists("../temp")) {
        mkdir("../temp");
    }

    $path_info = pathinfo($url);
    $targetName = $path_info["filename"];
    $ext = ".".$path_info["extension"];

    copy($projectUrl.$url, "../temp/".$targetName.$ext);
    rename("../temp/".$targetName.$ext, $projectUrl.$uploadDir.$targetName."-copy".$ext);

    echo json_encode($uploadDir.$targetName."-copy".$ext);
}

