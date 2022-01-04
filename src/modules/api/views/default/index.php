<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Site: https://yiiman.ir
 * AuthorName: gholamreza beheshtian
 * AuthorNumber:+989353466620 | +17272282283
 * AuthorCompany: YiiMan
 */

use kartik\tabs\TabsX;
use YiiMan\YiiBasics\lib\BaseConfigs;
use YiiMan\Setting\module\models\DynamicModel\Module;
use yii\helpers\Html;


/**
 * @var yii\web\View                                          $this
 * @var YiiMan\Setting\module\models\DynamicModel\models\SettingSearch $searchModel
 * @var yii\data\ActiveDataProvider                           $dataProvider
 * @var \YiiMan\Setting\module\components\Options             $options
 */

$this->title = Module::t('setting', 'Settings');
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
    .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
        float: right;
    }

    .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
        float: right;
    }

</style>
<div class="setting-index">
    <form action="" method="post" enctype="multipart/form-data">
        <h4><?= Html::encode($this->title) ?></h4>
        <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->csrfToken ?>">


        <div class="card" style="margin-top: 20px">
            <h3>تنظیمات اصلی سایت</h3>

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="logoB64" class="col-sm-2 control-label">لوگوی سایت</label>
                        <div class="col-md-6">


                            <img style="width: 72px;margin-bottom: 20px" src="<?= $options->logo ?>" alt="">

                            <input type="file" name="logo" id="logoB64" class="form-control"
                                   title="">
                        </div>
                        <span>لوگوی سایت را در این قسمت وارد نمایید</span>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="SelectedMap" class="col-sm-2 control-label">نقشه ی مورد استفاده در سایت</label>
                        <div class="col-md-4">
                            <?= \kartik\select2\Select2::widget(
                                [
                                    'name'       => 'SelectedMap',
                                    'hideSearch' => true,
                                    'data'       =>
                                        [
                                            'cedar'  => 'نقشه ی سیدار',
                                            'google' => 'نقشه ی گوگل',
                                            'neshan' => 'نقشه ی نشان'
                                        ],
                                    'value'      => $options->SelectedMap,
                                    'options'    => ['dir' => 'rtl']
                                ]
                            ) ?>
                        </div>
                        <span>انتخاب کنید سایت شما از کدام سرویس نقشه استفاده کند؟</span>

                    </div>
                </div>

            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="mapKey" class="col-sm-2 control-label">کلید نقشه ی گوگل</label>
                        <div class="col-md-6">
                            <input type="text" name="mapKey" id="mapKey" class="form-control"
                                   value="<?= $options->mapKey ?>" title="">
                        </div>
                        <span>جهت دریافت کلید API از  <a
                                    href="https://cloud.google.com/maps-platform/?__utma=102347093.1789805074.1533725911.1533725913.1533725913.1&__utmb=102347093.0.10.1533725913&__utmc=102347093&__utmx=-&__utmz=102347093.1533725913.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)&__utmv=-&__utmk=162210236&_ga=2.60352750.216346082.1533725911-1789805074.1533725911#get-started">اینجا</a> شروع کنید</span>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cedarmapKey" class="col-sm-2 control-label">کلید نقشه ی سیدارمپ</label>
                        <div class="col-md-6">
                            <input type="text" name="cedarmapKey" id="cedarmapKey" class="form-control"
                                   value="<?= $options->cedarmapKey ?>" title="">
                        </div>
                        <span>جهت دریافت کلید API از  <a
                                    href="https://www.cedarmaps.com">اینجا</a> شروع کنید</span>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="neshanMapKey" class="col-sm-2 control-label">کلید نقشه ی نشان(راژمان)</label>
                        <div class="col-md-6">
                            <input type="text" name="neshanMapKey" id="neshanMapKey" class="form-control"
                                   value="<?= $options->neshanMapKey ?>" title="">
                        </div>
                        <span>جهت دریافت کلید API از  <a
                                    href="https://neshan.org/">اینجا</a> شروع کنید</span>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="priceUnit" class="col-sm-2 control-label">واحد پول</label>
                        <div class="col-md-2">
                            <input type="text" name="priceUnit" id="priceUnit" class="form-control"
                                   value="<?= $options->priceUnit ?>" title="" required="required">
                        </div>
                        <span>واحد پول در همه ی قسمت های سایت که متن(تومان) یا (ریال) بکار رفته باشد، تغییر میکند</span>

                    </div>
                </div>

            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="HomeCardLimit" class="col-sm-2 control-label">روش رند شدن قیمت ها در سایت</label>
                        <div class="col-md-2">
                            <?= \kartik\select2\Select2::widget(
                                [
                                    'name'       => 'roundPrice',
                                    'hideSearch' => true,
                                    'data'       =>
                                        [
                                            'up'   => 'به بالا',
                                            'down' => 'به پایین'
                                        ],
                                    'value'      => $options->roundPrice,
                                    'options'    => ['dir' => 'rtl']
                                ]
                            ) ?>

                        </div>
                        <span>برای مثال قیمت 5.600 را به 6 (به بالا) و یا به 5.5 (به پایین) تبدیل میکند</span>

                    </div>
                </div>

            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="adminSubmitHomeStatus" class="col-sm-2 control-label">وضعیت ملک های ارسالی مدیران
                            سایت</label>
                        <div class="col-md-2">
                            <?= \kartik\select2\Select2::widget(
                                [
                                    'name'       => 'adminSubmitHomeStatus',
                                    'hideSearch' => true,
                                    'data'       =>
                                        [
                                            'publish'  => 'بدون تایید منتشر شود',
                                            'unverify' => 'باید حتما تایید شود'
                                        ],
                                    'value'      => $options->adminSubmitHomeStatus,
                                    'options'    => ['dir' => 'rtl']
                                ]
                            ) ?>

                        </div>
                        <span>این انتخاب مشخص میکند، آیا املاکی که توسط مدیران سایت ثبت میشود، به طور مستقیم بر روی سایت قرار بگیرد، یا در انتظار تایید مدیر ارشد بماند</span>

                    </div>
                </div>

            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="usersSubmitHomeStatus" class="col-sm-2 control-label">وضعیت ملک های ارسالی کاربران
                            عادی سایت</label>
                        <div class="col-md-2">
                            <?= \kartik\select2\Select2::widget(
                                [
                                    'name'       => 'usersSubmitHomeStatus',
                                    'hideSearch' => true,
                                    'data'       =>
                                        [
                                            'publish'  => 'بدون تایید منتشر شود',
                                            'unverify' => 'باید حتما تایید شود'
                                        ],
                                    'value'      => $options->usersSubmitHomeStatus,
                                    'options'    => ['dir' => 'rtl']
                                ]
                            ) ?>

                        </div>
                        <span>این انتخاب مشخص میکند، آیا املاکی که توسط کاربران عادی سایت ثبت میشود، به طور مستقیم بر روی سایت قرار بگیرد، یا در انتظار تایید مدیر ارشد بماند</span>
                    </div>
                </div>

            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="firmSubmitHomeStatus" class="col-sm-2 control-label">وضعیت ملک های ارسالی بنگاه های
                            املاک </label>
                        <div class="col-md-2">
                            <?= \kartik\select2\Select2::widget(
                                [
                                    'name'       => 'firmSubmitHomeStatus',
                                    'hideSearch' => true,
                                    'data'       =>
                                        [
                                            'publish'  => 'بدون تایید منتشر شود',
                                            'unverify' => 'باید حتما تایید شود'
                                        ],
                                    'value'      => $options->firmSubmitHomeStatus,
                                    'options'    => ['dir' => 'rtl']
                                ]
                            ) ?>

                        </div>
                        <span>این انتخاب مشخص میکند، آیا املاکی که توسط بنگاه های املاک در سایت ثبت میشود، به طور مستقیم بر روی سایت قرار بگیرد، یا در انتظار تایید مدیر ارشد بماند</span>

                    </div>
                </div>

            </div>


        </div>

        <?php
        if (class_exists(YiiMan\YiiBasics\lib\email::className())) {
            ?>
            <div class="card" style="margin-top: 20px">
                <h3>تنظیمات سیستم ایمیل</h3>

                <?php $id = 'emailServer' ?>
                <div class="row" style="margin-bottom: 10px">
                    <div class="form-group">
                        <label for="<?= $id ?>" class="col-sm-2 control-label">سرور ایمیل</label>
                        <div class="col-md-6">
                            <input type="text" name="<?= $id ?>" id="<?= $id ?>" class="form-control"
                                   value="<?= $options->{$id} ?>"
                                   title="" required="required">
                        </div>
                    </div>
                </div>

                <?php $id = 'emailPort' ?>
                <div class="row" style="margin-bottom: 10px">
                    <div class="form-group">
                        <label for="<?= $id ?>" class="col-sm-2 control-label">پورت سرور ایمیل</label>
                        <div class="col-md-6">
                            <input type="text" name="<?= $id ?>" id="<?= $id ?>" class="form-control"
                                   value="<?= $options->{$id} ?>"
                                   title="" required="required">
                        </div>
                    </div>
                </div>


                <?php $id = 'emailUsername' ?>
                <div class="row" style="margin-bottom: 10px">
                    <div class="form-group">
                        <label for="<?= $id ?>" class="col-sm-2 control-label">نام کاربر سرور ایمیل</label>
                        <div class="col-md-6">
                            <input type="text" name="<?= $id ?>" id="<?= $id ?>" class="form-control"
                                   value="<?= $options->{$id} ?>"
                                   title="" required="required">
                        </div>
                    </div>
                </div>

                <?php $id = 'emailPassword' ?>
                <div class="row" style="margin-bottom: 10px">
                    <div class="form-group">
                        <label for="<?= $id ?>" class="col-sm-2 control-label">نام کاربر سرور ایمیل</label>
                        <div class="col-md-6">
                            <input type="text" name="<?= $id ?>" id="<?= $id ?>" class="form-control"
                                   value="<?= $options->{$id} ?>"
                                   title="" required="required">
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="togglebutton col-sm-12 ">
                                <label class="col-sm-12" style="color: rgba(0, 0, 0, 0.87)">
                                    <?php $id = 'emailAfterRegisterStatus' ?>
                                    <label for="<?= $id ?>" class="col-sm-5 control-label"
                                           style="color: RGB(170, 170, 170);">فعال سازی یا غیر فعال سازی ارسال ایمیل
                                        پس از ثبت نام کاربر جدید</label>
                                    <input <?php


                                    if (!empty($options->{$id})) {
                                        echo 'checked=""';
                                    }
                                    ?> type="checkbox" value="enable" class="col-md-6" id="<?= $id ?>"
                                       name="<?= $id ?>">
                                    <span>چنانچه این بخش را خاموش کنید، پس از ثبت نام کاربران جدید، ایمیلی برای آنها ارسال نمی گردد.</span>
                                </label>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <?php
        }
        ?>
        <?php
        if (class_exists(YiiMan\YiiBasics\lib\sms::className())) {
            ?>
            <!-- تنظیمات سرویس پیامک -->
            <div class="card" style="margin-top: 20px">
                <h3>تنظیمات سرویس پیامک</h3>

                <!--					خاموش یا روشن کردن ارسال پیامک حین ثبت نام -->
                <div class="row" style="margin-top: 20px">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="togglebutton col-sm-12 ">
                                <label class="col-sm-12" style="color: rgba(0, 0, 0, 0.87)">
                                    <?php $id = 'smsOnRegister' ?>
                                    <label for="<?= $id ?>" class="col-sm-5 control-label"
                                           style="color: RGB(170, 170, 170);">فعال سازی یا غیر فعال سازی ارسال پیامک
                                        پس از ثبت نام کاربر جدید</label>
                                    <input <?php


                                    if (!empty($options->{$id})) {
                                        echo 'checked=""';
                                    }
                                    ?> type="checkbox" value="enable" class="col-md-6" id="<?= $id ?>"
                                       name="<?= $id ?>">
                                    <span>چنانچه این بخش را خاموش کنید، پس از ثبت نام کاربران جدید، پیامکی برای آنها ارسال نمی گردد.</span>
                                </label>

                            </div>

                        </div>
                    </div>

                </div>


                <?php $id = 'smsAPI' ?>
                <div class="row">
                    <div class="form-group" style="margin-top: 20px">
                        <label for="<?= $id ?>" class="col-sm-4 control-label">کلید API </label>
                        <div class="col-md-4">
                            <input type="text" name="<?= $id ?>" id="<?= $id ?>" class="form-control"
                                   value="<?= $options->{$id} ?>"
                                   title="" required="required">
                        </div>
                        <label for="<?= $id ?>" class="col-sm-4 control-label">کلید api سایت خود را از <a
                                    href="http://ama.YiiMan.ir/client/setting/account">اینجا</a> دریافت نمایید.</label>
                    </div>
                </div>

                <?php
                $id = 'SMSLine';
                ?>
                <div class="row">
                    <div class="form-group" style="margin-top: 20px">
                        <label for="<?= $id ?>" class="col-sm-4 control-label">شماره ی پیامک پیش فرض</label>
                        <div class="col-md-4">
                            <input type="text" name="<?= $id ?>" id="<?= $id ?>" class="form-control"
                                   value="<?= $options->{$id} ?>"
                                   title="" required="required">
                        </div>
                        <label for="<?= $id ?>" class="col-sm-4 control-label">شماره ی خطی که ار طریق آن پیامک را ارسال
                            می کنید ثبت نمایید، این شماره را می توانید از
                            <a href="http://ama.YiiMan.ir/Client/Lines">اینجا</a> دریافت نمایید.</label>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <?php
        if (realpath(__DIR__.'/../../../../childModules/setting/view.php')) {
            echo $this->render('@system/childModules/setting/view.php', ['options' => $options]);
        }
        ?>

        <button type="submit" style="position: fixed;
top: 91px;
left: 40px;
border-radius: 100px;" class="btn btn-success">ذخیره
        </button>

    </form>
</div>
