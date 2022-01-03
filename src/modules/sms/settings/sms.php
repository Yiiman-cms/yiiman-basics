<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 *
 * Site:https://yiiman.ir
 * Date: 03/25/2020
 * Time: 01:04 AM
 */

?>
<div class="tab-pane" id="sms">
    <div style="margin: -10px -12.5px -10px -10px;padding: 10px;">
        <div class="card" style="margin-top: 20px">
            <h3><?= Yii::t('sms', 'تنظیمات پیامک') ?></h3>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    $attr = 'smsAPI';
                    $model->addRule([$attr], 'required');
                    $model->addRule([$attr], 'trim');
                    $model->addRule([$attr], 'string', ['max' => 50]);
                    echo $form->field($model, $attr)->textInput()->hint(
                        Yii::t('settings', 'Enter Sms Token From Kaveh Negar')
                    );
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                    $attr = 'SMSDebug';
                    $model->addRule([$attr], 'required');
                    $model->addRule([$attr], 'trim');
                    $model->addRule([$attr], 'string', ['max' => 50]);
                    echo $form->field($model, $attr)->widget(
                        \kartik\select2\Select2::className(),
                        [
                            'data' =>
                                [
                                    1 => 'فعال',
                                    0 => 'غیر فعال'
                                ]
                        ]
                    )
                        ->label('حالت برنامه نویسی')
                        ->hint(
                            Yii::t('settings', 'روشن بودن حالت برنامه نویسی باعث میشود هیچ پیامکی از سیستم ارسال نشود.')
                        );
                    ?>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                        <?php
                        $attr = 'smsTestLine';
                        $model->addRule([$attr], 'required');
                        $model->addRule([$attr], 'trim');
                        $model->addRule([$attr], 'string', ['max' => 50]);
                        echo $form->field($model, $attr)->textInput()->hint(
                            Yii::t('sms', 'Enter Sms Test mobile phone for send test message')
                        );
                        ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    $attr = 'smsUsername';
                    $model->addRule([$attr], 'required');
                    $model->addRule([$attr], 'trim');
                    $model->addRule([$attr], 'string', ['max' => 50]);
                    echo $form->field($model, $attr)->textInput()->hint(
                        Yii::t('settings', 'نام کاربری پنل پیامک خود را وارد کنید')
                    );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    $attr = 'smsPassword';
                    $model->addRule([$attr], 'required');
                    $model->addRule([$attr], 'trim');
                    $model->addRule([$attr], 'string', ['max' => 50]);
                    echo $form->field($model, $attr)->textInput()->hint(
                        Yii::t('settings', 'رمز عبور پنل پیامک خود را وارد کنید')
                    );
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?php
                    $attr = 'SMSLine';
                    $model->addRule([$attr], 'required');
                    $model->addRule([$attr], 'trim');
                    $model->addRule([$attr], 'string', ['max' => 50]);
                    echo $form->field($model, $attr)->textInput()->hint(
                        Yii::t('settings', 'شماره ی خط ارسال را وارد کنید')
                    );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    $attr = 'MaxVerifySms';
                    $model->addRule([$attr], 'required');
                    $model->addRule([$attr], 'trim');
                    $model->addRule([$attr], 'string', ['max' => 50]);
                    echo $form->field($model, $attr)->textInput()->hint(
                        Yii::t('settings', 'حداکثر تعداد تلاش برای بازیابی رمز عبور در یک روز')
                    );
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php
                    $attr = 'SMSVerifyText';
                    $model->addRule([$attr], 'required');
                    $model->addRule([$attr], 'trim');
                    $model->addRule([$attr], 'string', ['max' => 200]);
                    echo $form->field($model, $attr)->textarea()->hint(
                        Yii::t('settings', 'متن ارسال پیامک کد راستی آزمایی را وارد کنید ')
                    );
                    ?>
                    <style>
                        .code-block {
                            background: #0000000d;
                            padding: 5px;
                            border-radius: 5px;
                            margin-left: 10px;
                            margin-top: 65px;
                            /* display: block; */
                            width: 100px;
                            text-align: center;
                            clear: both;
                            /* float: right; */
                            user-select: all;
                        }

                        .pcode-block {
                            margin-bottom: 19px;
                        }
                    </style>
                    <p>پارامتر های قابل استفاده:</p>
                    <p class="pcode-block"><span class="code-block">{{first_name}}</span><span
                                class="dcode-block">نام</span></p>
                    <p class="pcode-block"><span class="code-block">{{last_name}}</span><span class="dcode-block">نام خانوادگی</span>
                    </p>
                    <p class="pcode-block"><span class="code-block">{{site_name}}</span><span class="dcode-block">نام سایت</span>
                    </p>
                    <p class="pcode-block"><span class="code-block">{{verify_code}}</span><span class="dcode-block">کد ارسال شده</span>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php
                    $attr = 'SMSResetPassText';
                    $model->addRule([$attr], 'required');
                    $model->addRule([$attr], 'trim');
                    $model->addRule([$attr], 'string', ['max' => 200]);
                    echo $form->field($model, $attr)->textarea()->hint(
                        Yii::t('settings', 'متن ارسال پیامک تغییر رمز را وارد کنید، این متن زمانی استفاده میشود که کاربر مدیر، از پنل مدیریت رمز عبور یکی از کاربران را تغییر دهد ')
                    );
                    ?>
                    <style>
                        .code-block {
                            background: #0000000d;
                            padding: 5px;
                            border-radius: 5px;
                            margin-left: 10px;
                            margin-top: 65px;
                            /* display: block; */
                            width: 100px;
                            text-align: center;
                            clear: both;
                            /* float: right; */
                            user-select: all;
                        }

                        .pcode-block {
                            margin-bottom: 19px;
                        }
                    </style>
                    <p>پارامتر های قابل استفاده:</p>
                    <p class="pcode-block"><span class="code-block">{{first_name}}</span><span
                                class="dcode-block">نام</span></p>
                    <p class="pcode-block"><span class="code-block">{{last_name}}</span><span class="dcode-block">نام خانوادگی</span>
                    </p>
                    <p class="pcode-block"><span class="code-block">{{site_name}}</span><span class="dcode-block">نام سایت</span>
                    </p>
                    <p class="pcode-block"><span class="code-block">{{new_pass}}</span><span class="dcode-block">رمز عبور جدید</span>
                    </p>
                </div>
            </div>
            <a href="<?= Yii::$app->urlManager->createUrl(['/sms/default/sendtest']) ?>" class="btn btn-success">ارسال پیامک تست</a>
        </div>
    </div>
</div>
