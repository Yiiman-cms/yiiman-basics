<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043031_module_rbac_auth_item_child extends Migration
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
            '{{%module_rbac_auth_item_child}}',
            [
                'parent'=> $this->string(64)->notNull(),
                'child'=> $this->string(64)->notNull(),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('child','{{%module_rbac_auth_item_child}}',['child'],false);
        $this->addPrimaryKey('pk_on_module_rbac_auth_item_child','{{%module_rbac_auth_item_child}}',['parent','child']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_module_rbac_auth_item_child','{{%module_rbac_auth_item_child}}');
        $this->dropIndex('child', '{{%module_rbac_auth_item_child}}');
        $this->dropTable('{{%module_rbac_auth_item_child}}');
    }
}
