<?php

/**
 * Copyright (c) 2018-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\redactor\controllers;

use yii\web\Response;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since  2.0
 */
class UploadController extends \yii\web\Controller
{

    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            [
                'class'   => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON
                ],
            ]
        ];
    }

    public function actions()
    {
        return [
            'file'       => 'YiiMan\YiiBasics\widgets\redactor\actions\FileUploadAction',
            'image'      => 'YiiMan\YiiBasics\widgets\redactor\actions\ImageUploadAction',
            'image-json' => 'YiiMan\YiiBasics\widgets\redactor\actions\ImageManagerJsonAction',
            'file-json'  => 'YiiMan\YiiBasics\widgets\redactor\actions\FileManagerJsonAction',
        ];
    }

}
