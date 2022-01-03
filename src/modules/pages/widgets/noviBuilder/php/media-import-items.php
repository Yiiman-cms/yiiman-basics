<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

include_once("media-utils.php");

if (!isset($_POST["projectDir"]) || !isset($_POST["imgDir"]) || !isset($_POST["videoDir"])) {
    echo -1;
    die();
}

$projectDir = "../".$_POST["projectDir"];
$links = json_decode($_POST["links"], true);
$mediaDir = $projectDir."novi/media/";
$thumbsDir = $_POST["projectDir"]."novi/media/thumbnails/";
$imgDir = $projectDir.$_POST["imgDir"];
$videoDir = $projectDir.$_POST["videoDir"];
$extensions = [
    "jpeg",
    "jpg",
    "png",
    "gif"
];
$video_extensions = [
    "mp4",
    "webm",
    "avi",
    "ogg"
];
$video_previews = [];
$itemsToRemove = [];
$videosWithoutPreview = [];

if (!file_exists($mediaDir)) {
    mkdir($mediaDir, 0777, true);
}

if (!file_exists("../".$thumbsDir)) {
    mkdir("../".$thumbsDir, 0777, true);
}

$items = [];
if (file_exists($imgDir) && is_dir($imgDir)) {

    $di = new RecursiveDirectoryIterator($imgDir);
    foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
        if (is_dir($filename)) {
            continue;
        }
        $fileName = str_replace($imgDir, "", str_replace('\\', '/', $filename));

        if (in_array($fileName, $links)) {
            continue;
        }

        $info = pathinfo($fileName);
        $ext = $info['extension'];
        $baseName = $info["filename"];
        if (!in_array($ext, $extensions)) {
            continue;
        }
        if (file_exists($mediaDir.$baseName.'.'.$ext) && filesize($mediaDir.$baseName.'.'.$ext) === filesize($filename)) {
            continue;
        }
        $counter = 0;

        while (file_exists($mediaDir.$baseName.'.'.$ext)) {
            $counter++;
            $baseName = $baseName."-".$counter;
        }

        $newFileName = $baseName.".".$ext;

        if (createThumbnail($imgDir.$fileName, "../".$thumbsDir.$newFileName) !== false && copy($imgDir.$fileName,
                $mediaDir.$newFileName) !== false) {
            $size = getimagesize($filename);
            $item = [
                "original"  => $newFileName,
                "type"      => "image",
                "thumbnail" => $thumbsDir.$newFileName,
                "width"     => $size[0],
                "height"    => $size[1],
                "link"      => $_POST["imgDir"].$fileName
            ];

            array_push($items, $item);
        }
    }
}

if (file_exists($videoDir) && is_dir($videoDir)) {

    $di = new RecursiveDirectoryIterator($videoDir);
    foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
        if (is_dir($filename)) {
            continue;
        }
        $fileName = str_replace($videoDir, "", str_replace('\\', '/', $filename));

        if (in_array($fileName, $links)) {
            continue;
        }

        $info = pathinfo($fileName);
        $ext = $info['extension'];
        $baseName = $info["filename"];
        if (!in_array($ext, $video_extensions)) {
            continue;
        }
        if (file_exists($mediaDir.$baseName.'.'.$ext) && filesize($mediaDir.$baseName.'.'.$ext) === filesize($filename)) {
            continue;
        }
        $counter = 0;

        while (file_exists($mediaDir.$baseName.'.'.$ext)) {
            $counter++;
            $baseName = $baseName."-".$counter;
        }

        $newFileName = $baseName.".".$ext;

        if (copy($videoDir.$fileName, $mediaDir.$newFileName) !== false) {
            $size = getimagesize($filename);
            $item = [
                "original"  => $newFileName,
                "type"      => "video",
                "thumbnail" => "isLoading",
                "link"      => $_POST["videoDir"].$fileName
            ];

            array_push($items, $item);
        }
    }
}

echo json_encode($items);

