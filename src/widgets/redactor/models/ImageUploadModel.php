<?php

/**
 * Copyright (c) 2018-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\redactor\models;

use Yii;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since  2.0
 */
class ImageUploadModel extends FileUploadModel
{
    public function rules()
    {
        return [
            [
                'file',
                'file',
                'extensions' => Yii::$app->controller->module->imageAllowExtensions
            ]
        ];
    }

}
