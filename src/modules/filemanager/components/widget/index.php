<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace AngularFilemanager\LocalBridge;

/**
 *  PHP Local filesystem bridge for angular-filemanager
 * @author  Jakub Ďuraš <jakub@duras.me>
 * @version 0.2.0
 */
include 'LocalBridge/Response.php';
include 'LocalBridge/Rest.php';
include 'LocalBridge/Translate.php';
include 'LocalBridge/FileManagerApi.php';

/**
 * Takes two arguments
 * - base path without last slash (default: '$currentDirectory/../files')
 * - language (default: 'en'); mute_errors (default: true, will call ini_set('display_errors', 0))
 */
$fileManagerApi = new FileManagerApi();

$rest = new Rest();
$rest->post([
    $fileManagerApi,
    'postHandler'
])
    ->get([
        $fileManagerApi,
        'getHandler'
    ])
    ->handle();
