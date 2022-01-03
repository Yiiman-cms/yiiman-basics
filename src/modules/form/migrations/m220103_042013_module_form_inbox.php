<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_042013_module_form_inbox extends Migration
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
            '{{%module_form_inbox}}',
            [
                'id'=> $this->primaryKey(11),
                'ip'=> $this->string(15)->null()->defaultValue(null),
                'created_at'=> $this->datetime()->notNull(),
                'status'=> $this->tinyInteger(1)->notNull(),
                'details'=> $this->text()->notNull(),
                'title'=> $this->string(255)->null()->defaultValue(null),
                'form'=> $this->integer(11)->notNull(),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('form','{{%module_form_inbox}}',['form'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('form', '{{%module_form_inbox}}');
        $this->dropTable('{{%module_form_inbox}}');
    }
}
