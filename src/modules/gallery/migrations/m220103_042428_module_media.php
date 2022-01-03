<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_042428_module_media extends Migration
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
            '{{%module_media}}',
            [
                'id'=> $this->primaryKey(11),
                'file'=> $this->string(400)->notNull(),
                'type'=> $this->string(20)->notNull(),
                'path'=> $this->string(255)->notNull(),
                'status'=> $this->tinyInteger(1)->notNull(),
                'title'=> $this->string(255)->null()->defaultValue(null),
                'description'=> $this->text()->null()->defaultValue(null),
                'tableName'=> $this->string(255)->notNull(),
                'contentType'=> $this->string(255)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%module_media}}');
    }
}
