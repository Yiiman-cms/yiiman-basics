<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043531_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_module_ticket_department_users_uid',
            '{{%module_ticket_department_users}}','uid',
            '{{%module_user_admin}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_ticket_department_users_department',
            '{{%module_ticket_department_users}}','department',
            '{{%module_ticket_departments}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_ticket_messages_ticket',
            '{{%module_ticket_messages}}','ticket',
            '{{%module_ticket}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_ticket_messages_uid_admin',
            '{{%module_ticket_messages}}','uid_admin',
            '{{%module_user_admin}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_ticket_messages_uid',
            '{{%module_ticket_messages}}','uid',
            '{{%module_user}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_module_ticket_department_users_uid', '{{%module_ticket_department_users}}');
        $this->dropForeignKey('fk_module_ticket_department_users_department', '{{%module_ticket_department_users}}');
        $this->dropForeignKey('fk_module_ticket_messages_ticket', '{{%module_ticket_messages}}');
        $this->dropForeignKey('fk_module_ticket_messages_uid_admin', '{{%module_ticket_messages}}');
        $this->dropForeignKey('fk_module_ticket_messages_uid', '{{%module_ticket_messages}}');
    }
}
