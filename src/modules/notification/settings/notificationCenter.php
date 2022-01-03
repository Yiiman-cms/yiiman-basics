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
 */
$url = Yii::$app->urlManager->createUrl(['/transactions/default/loadform']);
$urlJs = Yii::$app->urlManager->createUrl(['/transactions/default/load-js']);
$js = <<<JS
    
JS;
Yii::$app->view->registerJs($js, Yii::$app->view::POS_END);



$js = <<<JS
function closeNotifs(){
    $('.notif-text-boxex').collapse('hide');
}
   
    $('.notif-act-header').click(function (e){
        closeNotifs();
        setTimeout(function (e){
            $(this).next().collapse('show');
        },1000);
        
    });
 closeNotifs();
JS;
Yii::$app->view->registerJs($js, Yii::$app->view::POS_END);
?>
<style>
    #nav_tab.cats li {
        width: 100%;
    }
    .nav-notifs {
        display: block;
        border: 1px #00000012 solid;
        background: #00bcd4 !important;
        border-radius: 5px !important;
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 12px -5px rgba(0, 188, 212, .46);
    }

    .tab-content.content-notif {
        display: block;
        padding: 51px 31px 19px;
        border: 1px dashed rgba(0, 188, 212, 0.35);
        border-radius: 6px;
        float: right;
        width: 100%;
        margin-top: -10px;
    }

    .tab-content.content-notif > div {
        width: 100%;
        float: right;
        height: auto;
    }

    .notification-acts-form {
        width: 100%;
        float: right;
        display: flex;
        position: relative;
    }

    .notif-module-box {
        display: block;
        width: auto;
        float: right;
    }

    .nav-notifs {
        display: block;
        border: 1px #00000012 solid;
        background: #00bcd4 !important;
        border-radius: 5px !important;
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 12px -5px rgba(0, 188, 212, .46);
        width: 98%;
        margin: auto;
        margin-bottom: -40px;
    }

    .notif-module-box {
        display: block;
        width: 100%;
    }

    .notif-module-body {
        border: dashed 1px #212121;
    }

    .notif-module-header {
        width: 98%;
        display: block;
        background: #212121 !important;
        color: white;
        padding: 5px;
        border-radius: 5px;
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 12px -5px rgba(33, 33, 33, .46);
        margin: auto;
    }

    .notif-module-body {
        border: 1px dashed rgba(33, 33, 33, 0.26);
        margin-top: -13px;
        border-radius: 4px;
        padding-top: 36px;
        padding-right: 18px;
        padding-left: 18px;
        float: right;
        width: 100%;
    }

    .notif-act-box {
        float: right;
        width: auto;
        border: 1px dashed rgb(126, 0, 212);
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 40px;
    }

    .notif-act-header {
        float: right;
        width: 99%;
        background: rgb(156, 39, 176) none repeat scroll 0% 0% !important;
        color: white;
        padding: 6px;
        border-radius: 4px;
        margin-top: -22px;
        box-shadow: rgba(0, 0, 0, 0.14) 0px 4px 20px 0px, rgba(156, 39, 176, 0.46) 0px 7px 12px -5px;
        margin-bottom: 12px;
    }
    .parameters-box {
        background: #d1d4dd40;
        border-radius: 5px;
        padding: 10px;
    }

    .parameters-box ul {
        display: inline-flex;
        list-style: none;
        flex-wrap: wrap;
    }

    .parameters-box li {
        background: #c1c4ee;
        margin: 4px;
        padding: 3px;
        border-radius: 5px;
        user-select: all;
    }
</style>
<div style="margin: -10px -12.5px -10px -10px;padding: 10px;">
    <div class="card" style="margin-top: 20px">
        <h3><?= Yii::t('transactions', 'تنظیمات اطلاعیه های سیستم') ?></h3>
        <div class="row">
            <div class="col-md-6">
                <?php
                $gates = [];
                $gatesFiles = getFileList(__DIR__ . '/../channels');
                $gatesFields = [];
                foreach ($gatesFiles as $gate) {
                    error_reporting(2048);
                    if ($gate['type'] == 'text/x-php') {
                        $className = str_replace('.php', '', $gate['name']);
                        $code = '$gates[\''.$className.'\'] = (new YiiMan\YiiBasics\modules\notification\channels\\' . $className . ')->title();';
                        try{

                            eval($code);
                        }catch (Exception $t){
                            $e=$t;
                        }
                        $code = '$gatesFields[\''.$className.'\'] =["label"=>$gates[\''.$className.'\'],"content"=> (new YiiMan\YiiBasics\modules\notification\channels\\' . $className . ')->renderForm($form)];';
                        try{
                            eval($code);
                        }catch (Exception $t){
                            $e=$t;
                        }
                    }
                }

                $attr = 'activeNotificationChannels';
                $model->addRule([$attr], 'required');
                $model->addRule([$attr], 'trim');
                $model->addRule([$attr], 'string', ['max' => 50]);
                echo $form->field($model, $attr)->checkboxList($gates)->hint(
                    Yii::t('settings', 'کانال های ارسال اطلاعیه به کاربران را فعال یا غیر فعال کنید - بدیهیست در صورت غیر فعال سازی هر کانال, هیچ کدام از اطلاعیه ها روی این کانال ارسال نمیشوند.')
                )->label('کانال های ارسال اطلاعیه');
                ?>
            </div>
            <div class="col-md-6">
                <?php

                $attr = 'NotificationDebug';
                $model->addRule([$attr], 'required');
                $model->addRule([$attr], 'trim');
                $model->addRule([$attr], 'string', ['max' => 50]);
                echo $form->field($model, $attr)->radioList(
                    [
                        0 => 'غیر فعال',
                        1 => 'فعال'
                    ]
                )->hint(
                    Yii::t('settings', 'در صورت فعال بودن حالت برنامه نویسی, هیچ اطلاعیه ای ارسال نمیشود.')
                )->label('حالت برنامه نویسی');
                ?>
            </div>
        </div>
        <div class="row notification-setting-tabs">
            <div class="card-content ">
                <ul id="nav_tab" class="nav nav-pills nav-pills-warning nav-notifs">
                    <li>
                        <a class="active show" href="#channelNotificationTexts" data-toggle="tab">پیکربندی اطلاعیه ها</a>
                    </li>
                    <?php
                    if (!empty($gatesFields)) {
                        foreach ($gatesFields as $name => $body) {
                            if (!empty($body['content'])) {
                                ?>
                                <li>
                                    <a href="#Notifications<?= $name ?>" data-toggle="tab">تنظیمات
                                        کانال <?= $body['label'] ?></a>
                                </li>
                                <?php
                            }
                        }
                    }
                    ?>
                </ul>
                <div class="tab-content content-notif">
                    <?= Yii::$app->view->render('@system/modules/notification/settings/tabs/notificationsTexts', ['model' => $model, 'form' => $form, 'gates' => $gates]) ?>
                    <?php
                    if (!empty($gatesFields)) {
                        foreach ($gatesFields as $name => $body) {
                            if (!empty($body['content'])) {
                                ?>
                                <div class="tab-pane" id="Notifications<?= $name ?>">
                                    <?= $body['content'] ?>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
