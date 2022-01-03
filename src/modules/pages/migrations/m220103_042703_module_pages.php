<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_042703_module_pages extends Migration
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
            '{{%module_pages}}',
            [
                'id'=> $this->primaryKey(11),
                'slug'=> $this->string(255)->null()->defaultValue(null),
                'content'=> $this->text()->notNull(),
                'status'=> $this->tinyInteger(1)->notNull(),
                'title'=> $this->string(255)->notNull(),
                'created_at'=> $this->datetime()->notNull(),
                'updated_at'=> $this->datetime()->null()->defaultValue(null),
                'image'=> $this->string(255)->null()->defaultValue(null),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
                'template'=> $this->string(255)->notNull(),
                'default'=> $this->tinyInteger(1)->null()->defaultValue(null),
                'seo_description'=> $this->string(255)->null()->defaultValue(null),
                'back'=> $this->text()->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('language_parent','{{%module_pages}}',['language_parent'],false);
        $this->createIndex('language','{{%module_pages}}',['language'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('language_parent', '{{%module_pages}}');
        $this->dropIndex('language', '{{%module_pages}}');
        $this->dropTable('{{%module_pages}}');
    }
}
