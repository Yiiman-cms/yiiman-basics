<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_042812_module_posttypes_fields extends Migration
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
            '{{%module_posttypes_fields}}',
            [
                'fieldName'=> $this->string(255)->notNull(),
                'content'=> $this->text()->null()->defaultValue(null),
                'posttype'=> $this->integer(11)->notNull(),
                'id'=> $this->primaryKey(11),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('posttype','{{%module_posttypes_fields}}',['posttype'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('posttype', '{{%module_posttypes_fields}}');
        $this->dropTable('{{%module_posttypes_fields}}');
    }
}
