<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

$langPath = "../lang/";
$allDataPath = $langPath."languages.json";
if (!file_exists($allDataPath)) {
    exit();
}
$allLang = json_decode(file_get_contents($allDataPath), true);

if (isset($allLang['en'])) {
    $enLang = $allLang['en'];
    $enFile = $enLang["file"];
    $allLang["en"]["data"] = json_decode(file_get_contents($langPath.$enFile), true);
}

if (isset($_POST['lang'])) {
    $lang = $_POST['lang'];

    if (isset($allLang[$lang]) && file_exists($langPath.$allLang[$lang]["file"])) {
        $file = $allLang[$lang]["file"];
        $allLang[$lang]["data"] = json_decode(file_get_contents($langPath.$file), true);
    } else {
        $allLang["error"] = true;
    }
}

foreach ($allLang as $key => $lang) {
    if (!file_exists($langPath.$lang["file"]) && $lang !== "error") {
        unset($allLang[$key]);
    }
}
echo json_encode($allLang);
