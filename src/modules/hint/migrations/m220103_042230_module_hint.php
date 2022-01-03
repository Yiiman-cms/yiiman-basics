<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_042230_module_hint extends Migration
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
            '{{%module_hint}}',
            [
                'id'=> $this->primaryKey(11),
                'date'=> $this->date()->notNull(),
                'count'=> $this->integer(11)->notNull()->defaultValue(0),
                'url'=> $this->string(255)->notNull()->defaultValue(''),
                'table'=> $this->string(255)->null()->defaultValue(null),
                'table_id'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%module_hint}}');
    }
}
