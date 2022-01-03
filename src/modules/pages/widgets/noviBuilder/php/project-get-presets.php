<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

if (isset($_POST['presets']) && isset($_POST['dir']) && !empty($_POST['presets'])) {
    $presets = json_decode($_POST['presets'], true);
    $dir = $_POST['dir'];
    for ($i = 0; $i < count($presets); $i++) {
        if (isset($presets[$i]["path"]) && !empty($presets[$i]["path"])) {
            $htmlPath = "../".$dir."elements/".$presets[$i]["path"];
            if (file_exists($htmlPath)) {
                $presets[$i]["html"] = file_get_contents($htmlPath);
            }
        }
    }

    echo json_encode($presets);
}

