<?php
/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:09353466620
 * Company Phone:05138846411
 * Site:https://yiiman.ir
 * Date: 03/25/2020
 * Time: 01:04 AM
 */

/**
 * @var $this \YiiMan\YiiBasics\lib\View
 * @var $model
 *
 */

$notificationActs = \YiiMan\YiiBasics\lib\Core::getNotificationNames();

?>
<div class="tab-pane active" id="channelNotificationTexts">
    <div class="notification-acts-form">
        <div class="row">
            <div class="col-md-4">
                <ul id="nav_tab"
                    class="nav nav-notifs  cats nav-pills nav-pills-rose flex-column">
                    <li style="width: 100%;margin-bottom: 10px;text-align: center;font-weight: 600;">گروه اعلانات</li>
                    <?php
                    if (!empty($notificationActs)) {
                        $isFirst = true;
                        foreach ($notificationActs as $moduleName => $moduleBody) {
                            ?>
                            <li>
                                <a class="<?= $isFirst ? 'active show' : '' ?>" href="#notif<?= $moduleName ?>text"
                                   data-toggle="tab"><?= $moduleBody['label'] ?></a>
                            </li>
                            <?php
                            $isFirst = false;
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="tab-content">
                    <?php
                    if (!empty($notificationActs)) {
                        $isFirst = true;
                        foreach ($notificationActs as $moduleName => $moduleBody) {
                            ?>
                            <div class="notif-text-pan tab-pane <?= $isFirst ? 'active' : '' ?>"
                                 id="notif<?= $moduleName ?>text">
                                <?php
                                if (!empty($moduleBody['items'])) {
                                    foreach ($moduleBody['items'] as $actName => $actBody) {
                                        if (empty($actBody['hint'])) {
                                            $hint = false;
                                        } else {
                                            $hint = $actBody['hint'];
                                        }
                                        ?>
                                        <div class="notif-act-box ">
                                            <div class="notif-act-header"><?= $actBody['label'] ?></div>
                                            <div class="notif-act-body notif-text-boxex">

                                                <?php
                                                if (!empty($hint)) {
                                                    echo '<h4>' . $hint . '</h4><hr>';
                                                }
                                                $attr = $actName . '_text';
                                                echo '<h4>متن پیام را با استفاده از پارامترهایی که به شما داده شده است تنظیم کنید</h4>';
                                                //$model->addRule([$attr], 'required');
                                                echo $form->field($model, $attr)->textarea()->label(false);
                                                ?>
                                                <hr>
                                                <div class="parameters-box">
                                                    <h4>پارامتر های سیستمیک مخصوص این اطلاعیه</h4>
                                                    <ul>
                                                        <?php
                                                        if (!empty($actBody['params'])) {
                                                            foreach ($actBody['params'] as $name => $popup) {
                                                                ?>
                                                                <li <?= \YiiMan\YiiBasics\widgets\TippyTooltip\TippyWidget::attribute
                                                                (
                                                                    \Yii::t
                                                                    ('settings', 'Dynamic Parameter: ({p}) with value: ({v}) can change in system>parameters menu',
                                                                        [
                                                                            'p' => $name,
                                                                            'v' => $popup
                                                                        ]
                                                                    )

                                                                )
                                                                ?>>
                                                                    {{<?= $name ?>}}
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                    <hr>
                                                    <h4><a target="_blank"
                                                           href="<?= Yii::$app->urlManager->createUrl(['/parameters']) ?>">پارامتر
                                                            های تعریف شده ی شما</a></h4>
                                                    <ul>
                                                        <li <?= \YiiMan\YiiBasics\widgets\TippyTooltip\TippyWidget::attribute(\Yii::t('settings', 'user\'s (first name + last name)')) ?>>
                                                            {{fullname}}
                                                        </li>
                                                        <li <?= \YiiMan\YiiBasics\widgets\TippyTooltip\TippyWidget::attribute(\Yii::t('settings', 'Site title')) ?>>
                                                            {{siteTitle}}
                                                        </li>
                                                        <?php
                                                        foreach (\YiiMan\YiiBasics\modules\parameters\models\Parameters::getAllParameters() as $key => $param) {
                                                            ?>
                                                            <li <?= \YiiMan\YiiBasics\widgets\TippyTooltip\TippyWidget::attribute
                                                            (
                                                                \Yii::t
                                                                ('settings', 'Dynamic Parameter: ({p}) with value: ({v}) can change in system>parameters menu',
                                                                    [
                                                                        'p' => $param['description'],
                                                                        'v' => $param['val']
                                                                    ]
                                                                )

                                                            )
                                                            ?>>
                                                                {{<?= $key ?>}}
                                                            </li>
                                                            <?php
                                                        }

                                                        ?>
                                                    </ul>
                                                    <hr>

                                                    <h4>مشخص کنید اطلاعیه با چه روش هایی ارسال شود:</h4>

                                                    <?php
                                                    $attr = $actName;
                                                    $model->addRule([$attr], 'trim');
                                                    $model->addRule([$attr], 'string', ['max' => 50]);
                                                    echo $form->field($model, $attr)->checkboxList(
                                                        $gates
                                                    )->label(false);
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <?php
                            $isFirst = false;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>


    </div>
</div>
