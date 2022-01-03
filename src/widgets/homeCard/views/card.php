<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: 8/20/2018
 * Time: 12:32 PM
 */

/**
 * @var $home \common\models\Homes
 */
?>

<div class="article  col-lg-3 col-sm-6 col-12">
    <a href="<?= Yii::$app->urlManager->createUrl(['/home/'.$home->hash]) ?>" class="article-details">
        <div class="article-image"
             style="background-image: url('/assets/images/img1.png');">
            <div class="details">
                <div>
                    <span class="article-addr"><?= $home->neighbourhood ?></span>
                    <h2 class="article-title"><?= $home->priceTitrText().' '.$home->size_of_land.' '.'متر' ?></h2>
                </div>
            </div>
        </div>
        <div class="article-footer">
            <?= $home->footerPrice() ?>
        </div>
    </a>
</div>
