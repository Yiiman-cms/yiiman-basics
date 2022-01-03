<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

if (isset($_POST['dir'])) {
    $project_dir = $_POST['dir'];
    $sourceUrl = "../".$project_dir."bat/rd-mailform.php";

    if (file_exists($sourceUrl) && !empty($sourceUrl)) {
        $content = file_get_contents($sourceUrl);
        if (preg_match("/recipients\s*=\s*[\"\']([^\"\']*)[\"\'];/i", $content, $matches)) {
            echo json_encode(["emails" => $matches[1]]);
        } else {
            echo json_encode(["emails" => ""]);
        }
    }
}

