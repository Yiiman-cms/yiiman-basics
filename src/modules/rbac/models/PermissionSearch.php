<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\rbac\models;

use Yii;
use yii\rbac\Item;

/**
 * @author John Martin <john.itvn@gmail.com>
 * @since  1.0.0
 */
class PermissionSearch extends AuthItemSearch
{

    public function __construct($config = [])
    {
        parent::__construct($item = null, $config);
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['name'] = Yii::t('rbac', 'Permission name');
        return $labels;
    }

    protected function getType()
    {
        return Item::TYPE_PERMISSION;
    }

}
