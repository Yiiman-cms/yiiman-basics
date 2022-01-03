<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: 03/25/2020
 * Time: 01:04 AM
 */

/**
 * @var $this \YiiMan\YiiBasics\lib\View
 * @var $model
 */

$notificationActs = \YiiMan\YiiBasics\lib\Core::getNotificationNames();
?>
<div class="tab-pane active" id="channelNotifications">
    <div class="notification-acts-form">
        <?php
        if (!empty($notificationActs)) {
            foreach ($notificationActs as $moduleName => $moduleBody) {
                ?>
                <div class="notif-module-box">
                    <div class="notif-module-header"><?= $moduleBody['label'] ?></div>
                    <div class="notif-module-body">
                        <?php
                        if (!empty($moduleBody['items'])) {
                            foreach ($moduleBody['items'] as $actName => $actBody) {
                                if (empty($actBody['hint'])) {
                                    $hint = false;
                                } else {
                                    $hint = $actBody['hint'];
                                }
                                ?>
                                <div class="notif-act-box">
                                    <div class="notif-act-header"><?= $actBody['label'] ?></div>
                                    <div class="notif-act-body">
                                        <?php
                                        $attr = $actName;
                                        $model->addRule([$attr], 'trim');
                                        $model->addRule([$attr], 'string', ['max' => 50]);
                                        echo $form->field($model, $attr)->checkboxList(
                                            $gates
                                        )->label(false)->hint($hint);
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>

    </div>
</div>
