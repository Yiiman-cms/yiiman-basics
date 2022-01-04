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
 * @var $this  \YiiMan\YiiBasics\lib\View
 * @var $model YiiMan\Setting\module\models\DynamicModel;
 */
?>
<style>
    minute {
        padding: 2px;
        background: #aadae8;
        border-radius: 3px;
        margin-top: 11px;
        display: inline-block;
        width: auto;
        cursor: pointer;
        user-select: all;
    }
</style>

<div style="margin: -10px -12.5px -10px -10px;padding: 10px;">
    <div class="card" style="margin-top: 20px">
        <h3><?= Yii::t('sessions', 'تنظیمات نشست های کاربران') ?></h3>
        <div class="row">
            <?php
            foreach (\YiiMan\YiiBasics\lib\Core::getAppsList() as $id => $label) {
                ?>
                <div class="col-md-6">
                    <?php
                    $attr = 'SessionTimeOut'.str_replace([
                            '-',
                            '_'
                        ], '', $id);
                    $model->addRule([$attr], 'required');
                    $model->addRule([$attr], 'trim');
                    $model->addRule([$attr], 'integer', ['max' => 519000]);
                    if (empty($model->{$attr})) {
                        $model->setAttribute($attr, 100);
                    }
                    echo $form->field($model, $attr)->input('number')->hint(
                        Yii::t('sessions',
                            'مشخص کنید تنظیمات نشست برای کاربرانی که در برنامه ی '.$label.' حضور دارند حداکثر چند دقیقه حفظ شود؟')
                    )->label('انقضای '.$label);
                    ?>
                </div>
                <?php
            }
            ?>

        </div>

        <div class="row">
            <div class="col-md-12">
                <h4>توضیحاتی در مورد زمان نشست ها</h4>
                <ul>
                    <li>تنظیمات هر نشست به صورت مجزا اعمال میگردد</li>
                    <li>منظور از یک نشست, اطلاعاتی است که از یک کاربر در سیستم به صورت موقت ثبت میشود.
                        این اطلاعات میتواند اطلاعات لاگین فرد باشد که پس از منقضی شدن کاربر را وادار میکند مجددا وارد
                        سیستم شود.

                        همچنین انتخاب هایی که کاربر در سیستم انجام میدهد, مانند انتخاب شهر, موقعیت جغرافیایی, جست و جو
                        هایی که انجام میدهد و ...
                    </li>
                    <li style="color: darkred">
                        هر قدر زمان انقضای نشست نزدیک به صفر باشد, کاربران تجربه ی کاربری بدتری را تجربه خواهند کرد,
                        زیرا سیستم فقط در مدت زمان کوتاهی میتواند اطلاعات موقتی را که برای شناخت کاربر نیاز دارد به خاطر
                        بسپارد.
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>مقادیر کمکی</h4>
                <ul>
                    <li>هر ساعت :
                        <minute>۶۰</minute>
                        دقیقه
                    </li>
                    <li>هر ۱۲ ساعت :
                        <minute>۷۲۰</minute>
                        دقیقه
                    </li>
                    <li>هر ۱ روز :
                        <minute>۱۴۴۰</minute>
                        دقیقه
                    </li>
                    <li>هر ۲ روز :
                        <minute>۲۸۸۰</minute>
                        دقیقه
                    </li>
                    <li>هر هفته :
                        <minute>۱۰۰۸۰</minute>
                        دقیقه
                    </li>
                    <li>هر دو هفته :
                        <minute>۲۰۱۶۰</minute>
                        دقیقه
                    </li>
                    <li>هر ماه :
                        <minute>۴۳۲۰۰</minute>
                        دقیقه
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

