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

class m220103_043030_module_rbac_auth_item extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%module_rbac_auth_item}}',
            [
                'name'            => $this->string(64)->notNull(),
                'type'            => $this->smallInteger(6)->notNull(),
                'description'     => $this->text()->null()->defaultValue(null),
                'rule_name'       => $this->string(64)->null()->defaultValue(null),
                'data'            => $this->binary()->null()->defaultValue(null),
                'created_at'      => $this->integer(11)->null()->defaultValue(null),
                'updated_at'      => $this->integer(11)->null()->defaultValue(null),
                'module_en'       => $this->string(255)->null()->defaultValue(null),
                'module_fa'       => $this->string(255)->null()->defaultValue(null),
                'language'        => $this->integer(11)->null()->defaultValue(null),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('rule_name', '{{%module_rbac_auth_item}}', ['rule_name'], false);
        $this->createIndex('idx-auth_item-type', '{{%module_rbac_auth_item}}', ['type'], false);
        $this->addPrimaryKey('pk_on_module_rbac_auth_item', '{{%module_rbac_auth_item}}', ['name']);

    }

    public function safeDown()
    {
        $this->dropPrimaryKey('pk_on_module_rbac_auth_item', '{{%module_rbac_auth_item}}');
        $this->dropIndex('rule_name', '{{%module_rbac_auth_item}}');
        $this->dropIndex('idx-auth_item-type', '{{%module_rbac_auth_item}}');
        $this->dropTable('{{%module_rbac_auth_item}}');
    }
}
