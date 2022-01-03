<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_042813_module_posttypes_fk extends Migration
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
            '{{%module_posttypes_fk}}',
            [
                'posttype_from'=> $this->integer(11)->notNull(),
                'posttype_to'=> $this->integer(11)->notNull(),
                'posttype_type_from'=> $this->string(255)->notNull(),
                'posttype_type_to'=> $this->string(255)->notNull(),
                'id'=> $this->primaryKey(11),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('posttype','{{%module_posttypes_fk}}',['posttype_from'],false);
        $this->createIndex('posttype_related','{{%module_posttypes_fk}}',['posttype_to'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('posttype', '{{%module_posttypes_fk}}');
        $this->dropIndex('posttype_related', '{{%module_posttypes_fk}}');
        $this->dropTable('{{%module_posttypes_fk}}');
    }
}
