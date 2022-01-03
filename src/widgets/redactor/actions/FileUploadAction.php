<?php
/**
 * Copyright (c) 2018-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\redactor\actions;

use Yii;
use yii\base\Action;
use YiiMan\YiiBasics\widgets\redactor\models\FileUploadModel;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since  2.0
 */
class FileUploadAction extends Action
{
    function run()
    {
        if (isset($_FILES)) {
            $model = new FileUploadModel();
            if ($model->upload()) {
                return $model->getResponse();
            } else {
                return ['error' => 'Unable to save file'];
            }
        }
    }

}
