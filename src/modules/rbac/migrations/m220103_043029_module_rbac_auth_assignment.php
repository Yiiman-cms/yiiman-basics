<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043029_module_rbac_auth_assignment extends Migration
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
            '{{%module_rbac_auth_assignment}}',
            [
                'item_name'=> $this->string(64)->notNull(),
                'user_id'=> $this->string(64)->notNull(),
                'created_at'=> $this->datetime()->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('idx-auth_assignment-user_id','{{%module_rbac_auth_assignment}}',['user_id'],false);
        $this->addPrimaryKey('pk_on_module_rbac_auth_assignment','{{%module_rbac_auth_assignment}}',['item_name','user_id']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_module_rbac_auth_assignment','{{%module_rbac_auth_assignment}}');
        $this->dropIndex('idx-auth_assignment-user_id', '{{%module_rbac_auth_assignment}}');
        $this->dropTable('{{%module_rbac_auth_assignment}}');
    }
}
