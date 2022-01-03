<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_032514_module_blog_category extends Migration
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
            '{{%module_blog_category}}',
            [
                'id'=> $this->primaryKey(11),
                'title'=> $this->string(255)->notNull(),
                'parent'=> $this->integer(11)->null()->defaultValue(null),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('parent','{{%module_blog_category}}',['parent'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('parent', '{{%module_blog_category}}');
        $this->dropTable('{{%module_blog_category}}');
    }
}
