<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

if (isset($_POST['dir']) && isset($_POST['destination'])) {
    $project_dir = $_POST['dir'];
    $destination = $_POST['destination'];
    $sourceUrl = "../".$project_dir."bat/rd-mailform.php";

    if (file_exists($sourceUrl) && !empty($sourceUrl)) {
        $content = file_get_contents($sourceUrl);
        file_put_contents($sourceUrl,
            preg_replace("/(recipients\s*=\s*[\"\'])([^\"\']*)([\"\'];)/", "$1".$destination."$3", $content));
        echo json_encode(['emails' => $destination]);
    }
}

