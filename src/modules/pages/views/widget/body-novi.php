<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use YiiMan\YiiBasics\modules\pages\models\Pages;
use YiiMan\YiiBasics\modules\pages\widgets\noviBuilder\assets\Assets;

/**
 * @var $id int
 */
$assets = Assets::register($this);
$model = Pages::findOne($id);
file_put_contents(Yii::$app->Options->UploadDir.'/samplePages/index.php', $model->content);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>&#65279;</title>

    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">

    <link rel="icon" href="<?= $assets->baseUrl ?>/images/favicon.ico" type="image/x-icon">

    <!-- Stylesheets-->
    <link rel="stylesheet" id="styles" href="<?= $assets->baseUrl ?>/css/style.css">
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,900%7CRoboto:500,400,100,300,600'
          rel='stylesheet' type='text/css'>
</head>
<body>

<!-- Novi Builder -->
<div id="builder"></div>
<script>
    var assetURL = '<?= $assets->baseUrl ?>';
</script>
<!-- Emmet -->
<script src="<?= $assets->baseUrl ?>/js/code-editor/emmet.js"></script>
<script src="<?= $assets->baseUrl ?>/js/code-editor/ace/ace.js"></script>
<script src="<?= $assets->baseUrl ?>/js/code-editor/ace/ext-emmet.js"></script>
<script src="<?= $assets->baseUrl ?>/js/builder.min.js?ver=<?= rand(1111, 9999) ?>"></script>

<script type="application/javascript">
    var isCookieEnabled, scriptTag, styleTag, id;
    isCookieEnabled = navigator.cookieEnabled;
    id = "";


</script>
</body>
</html>
