<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_042815_module_posttypes_multiples_fields extends Migration
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
            '{{%module_posttypes_multiples_fields}}',
            [
                'id'=> $this->primaryKey(255),
                'key'=> $this->string(255)->notNull(),
                'value'=> $this->string(255)->notNull(),
                'posttype_id'=> $this->integer(11)->notNull(),
                'posttype'=> $this->string(255)->notNull(),
                'posttype_field_name'=> $this->string(255)->notNull(),
                'multiple_field_name'=> $this->string(255)->notNull(),
                'multiple_field_id'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('module_posttypes_multiples_fields_ibfk_1','{{%module_posttypes_multiples_fields}}',['multiple_field_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('module_posttypes_multiples_fields_ibfk_1', '{{%module_posttypes_multiples_fields}}');
        $this->dropTable('{{%module_posttypes_multiples_fields}}');
    }
}
