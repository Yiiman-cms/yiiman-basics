<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

if (isset($_POST['sourceFile']) && isset($_POST["destination"])) {
    $sourcefileName = basename($_POST['sourceFile']);
    $sourceFile = iconv("utf-8", "cp1251", $_POST['sourceFile']);
    $destName = $_POST['destination'].$sourcefileName;
    $destForMove = iconv("utf-8", "cp1251", $destName);
    if (file_exists("../".$sourceFile) && rename("../".$sourceFile, "../".$destForMove)) {
        echo $sourcefileName;
    } else {
        echo -1;
    }
}









