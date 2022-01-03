<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

include 'session.php';
if (isset($_POST["files"]) && isset($_POST["token"]) && isset($_POST["path"])) {
    $targetToken = $_POST["token"];
    if ($targetToken === $currentToken || !$currentToken) {
        $filenames = json_decode($_POST["files"], true);
        $path = $_POST["path"];
        for ($i = 0; $i < count($filenames); $i++) {
            $filename = $filenames[$i];
            $filePath = "../".$path.$filename;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        echo json_encode(["result" => true]);
    } else {
        echo json_encode(["result" => false]);
    }
} 