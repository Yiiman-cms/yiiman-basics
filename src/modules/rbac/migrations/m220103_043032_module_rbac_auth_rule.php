<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043032_module_rbac_auth_rule extends Migration
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
            '{{%module_rbac_auth_rule}}',
            [
                'name'=> $this->string(64)->notNull(),
                'data'=> $this->binary()->null()->defaultValue(null),
                'created_at'=> $this->integer(11)->null()->defaultValue(null),
                'updated_at'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->addPrimaryKey('pk_on_module_rbac_auth_rule','{{%module_rbac_auth_rule}}',['name']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_module_rbac_auth_rule','{{%module_rbac_auth_rule}}');
        $this->dropTable('{{%module_rbac_auth_rule}}');
    }
}
