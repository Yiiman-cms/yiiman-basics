<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\db\Schema;
use yii\db\Migration;

class m220103_043033_Relations extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_module_rbac_auth_assignment_item_name',
            '{{%module_rbac_auth_assignment}}', 'item_name',
            '{{%module_rbac_auth_item}}', 'name',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_rbac_auth_item_rule_name',
            '{{%module_rbac_auth_item}}', 'rule_name',
            '{{%module_rbac_auth_rule}}', 'name',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_rbac_auth_item_child_parent',
            '{{%module_rbac_auth_item_child}}', 'parent',
            '{{%module_rbac_auth_item}}', 'name',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_rbac_auth_item_child_child',
            '{{%module_rbac_auth_item_child}}', 'child',
            '{{%module_rbac_auth_item}}', 'name',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_module_rbac_auth_assignment_item_name', '{{%module_rbac_auth_assignment}}');
        $this->dropForeignKey('fk_module_rbac_auth_item_rule_name', '{{%module_rbac_auth_item}}');
        $this->dropForeignKey('fk_module_rbac_auth_item_child_parent', '{{%module_rbac_auth_item_child}}');
        $this->dropForeignKey('fk_module_rbac_auth_item_child_child', '{{%module_rbac_auth_item_child}}');
    }
}
