<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\report\views;


use YiiMan\YiiBasics\lib\ActiveRecord;

interface View
{
    public function columns();

    /**
     * لیست فیلد هایی که باید در فرم جست و جوی پیشرفته درج شود
     * @param $form
     * @return []
     */
    public function searchFields($form);

    /**
     * لیست کلید هایی که باید در هر ردیف گرید index نمایش داده شود.
     * @return string
     */
    public function IndexButtons();

    /**
     * نام صفحه ی لیست گزارشات
     * @return string
     */
    public function reportTitle();

    /**
     * لیست برچسب ترجمه ی فیلد های مدل جبت و جوی شما
     * @return []
     */
    public function AttributeLabels();

    /**
     * تزریق فیلتر های جدید به جست و جو
     * خروجی این تابع باید تابعی از لیست فیلد های تغییر داده شده باشد
     * برای مثال اگر فیلد سرویس را دستخوش تغییراتی میکنید باید خروجی تابع به این شکل باشد:
     * return ['service']
     * @param $query \yii\db\ActiveQuery
     * @param $model \yii\db\ActiveRecord
     */
    public function filterParse(&$query, &$model);
}