<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043527_module_ticket_department_users extends Migration
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
            '{{%module_ticket_department_users}}',
            [
                'id'=> $this->primaryKey(11),
                'department'=> $this->integer(11)->notNull()->comment('دپارتمان'),
                'uid'=> $this->integer(11)->notNull()->comment('کاربر'),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('uid','{{%module_ticket_department_users}}',['uid'],false);
        $this->createIndex('department','{{%module_ticket_department_users}}',['department'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('uid', '{{%module_ticket_department_users}}');
        $this->dropIndex('department', '{{%module_ticket_department_users}}');
        $this->dropTable('{{%module_ticket_department_users}}');
    }
}
