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
 * Date: 12/15/2018
 * Time: 3:03 AM
 */

namespace YiiMan\YiiBasics\lib;


use yii\db\ActiveRecord;

class Model extends ActiveRecord
{
    public function save($runValidation = true, $attributeNames = null)
    {

        return parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub

    }

}
