<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_032512_module_blog_articles extends Migration
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
            '{{%module_blog_articles}}',
            [
                'id'=> $this->primaryKey(11),
                'title'=> $this->string(255)->notNull(),
                'content'=> $this->text()->notNull(),
                'created_at'=> $this->datetime()->notNull(),
                'author'=> $this->integer(11)->notNull(),
                'status'=> $this->tinyInteger(1)->notNull(),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
                'enable_comment'=> $this->tinyInteger(1)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%module_blog_articles}}');
    }
}
