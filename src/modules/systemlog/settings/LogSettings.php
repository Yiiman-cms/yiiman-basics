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
 */
?>
<style>
    code {
        background: black;
        width: 100%;
        display: block;
        min-height: 200px;
        padding: 10px;
        color: white;
        direction: ltr;
        text-align: left;
        overflow-y: auto;
        max-height: 200px;
    }

    .response-row h4 {
        text-align: center;
    }

    .response-row {
        display: none;
    }
</style>

<div style="margin: -10px -12.5px -10px -10px;padding: 10px;">
    <div class="card" style="margin-top: 20px">
        <h3><?= Yii::t('systemlog', 'تنظیمات خطایابی') ?></h3>
        <div class="row">

            <div class="col-md-6">
                <?php
                $attr = 'LogEnabled';
                $model->addRule([$attr], 'required');
                $model->addRule([$attr], 'trim');
                $model->addRule([$attr], 'string', ['max' => 50]);
                echo $form->field($model, $attr)->dropDownList(
                    [
                        0 => 'غیر فعال',
                        1 => 'فعال'
                    ]
                )->hint(
                    Yii::t('settings', 'در صورت فعال بودن این گزینه, خطاهای رخ داده در سیستم در بانک داده ثبت میشود.')
                )->label('وضعیت');
                ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php
                $attr = 'LogLevels';
                $model->addRule([$attr], 'trim');
                $model->addRule([$attr], 'string', ['max' => 10]);

                echo $form->field($model, $attr)->checkboxList(
                    [
                        'error' => 'خطا',
                        'warning' => 'هشدار',
                        'info' => 'اطلاعیه(لاگ)'
                    ]
                )->hint(
                    Yii::t('sms', 'مشخص کنید کدام یک از این رخداد ها توسط سیستم خطایابی رهگیری شود؟')
                )->label('کدام رخداد ها ثبت شود؟');
                ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>توضیحاتی در مورد فعال سازی انواع رخداد</h4>
                <ul>
                    <li>خطا: فقط خطاهای رخ داده در سیستم را ثبت میکند</li>
                    <li>هشدار: هشدار های سیستم را ثبت میکند, ممکن است در برخی بخش ها اندکی سیستم کند شود.</li>
                    <li style="color: darkred">اطلاعیه(لاگ) : این نوع خطایابی سیستم در سیستم چندین برابر افت سرعت ایجاد میکند, چرا که از ریز ترین اتفاقات رخ داده در سیستم نمونه برداری میکند.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

