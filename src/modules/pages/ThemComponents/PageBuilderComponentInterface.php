<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/10/2022 AD 06:22
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents;

interface PageBuilderComponentInterface
{
    /**
     * نام فارسی کامپوننت در صفحه ساز
     * @return string
     */
    public function title(): string;

    /**
     * کد جاوا اسکریپتی که این کامپوننت را در قالب سایت معرفی میکند
     * @return string|void
     */
    public function jQueryEngineJsCode();

    /**
     * کد فعال سازی(فراخوانی) و اینیشیالایز این کامپوننت در جاوا اسکریپت
     * @return string|void
     */
    public function javascriptActiveCode();

    /**
     *
     * آپشن هایی که برای تنظیم این کامپوننت در صفحه ساز در اختیار کاربر قرار میگیرد
     * @return PageBuilderPropertyArray
     */
    public function properties():PageBuilderPropertyArray;

    /**
     * کد جاوا اسکریپتی که قبل از اینیشیالایز آپشن های کامپوننت در صفحه ساز اجرا میشود
     * @return string|void
     */
    public function BeforeInitJsCode();


    /**
     *
     * کامپوننت های زیرمجموعه ی این کامپوننت
     * @return PageBuilderChildComponent
     */
    public function child():PageBuilderChildComponent;

    /**
     * کدی که پس از درگ کردن در صفحه نمایش داده میشود
     * @return string
     */
    public function html():string;
}