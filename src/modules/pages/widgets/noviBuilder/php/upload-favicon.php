<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

$uploadDir = 'images/';
$result = [];

if (isset($_POST["dir"]) && isset($_FILES["file"]) && !empty($_FILES["file"])) {
    $mimetype = mime_content_type($_FILES["file"]["tmp_name"]);
    if (!in_array($mimetype, [
        'image/jpeg',
        'image/png',
        'image/x-icon'
    ])) {
        http_response_code("406");
        echo "The wrong favicon format is selected. Only . jpg, .png, .ico formats are supported.";
        exit();
    }
    $projectName = $_POST["dir"];
    $baseName = $_FILES["file"]["name"];
    $tmpName = "../".$projectName.$uploadDir.$baseName;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $tmpName)) {
        $result['url'] = $uploadDir.$baseName;
    }
}

echo json_encode($result); 