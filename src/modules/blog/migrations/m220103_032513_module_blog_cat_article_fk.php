<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_032513_module_blog_cat_article_fk extends Migration
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
            '{{%module_blog_cat_article_fk}}',
            [
                'id'=> $this->primaryKey(11),
                'category'=> $this->integer(11)->notNull(),
                'article'=> $this->integer(11)->notNull(),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('category','{{%module_blog_cat_article_fk}}',['category'],false);
        $this->createIndex('article','{{%module_blog_cat_article_fk}}',['article'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('category', '{{%module_blog_cat_article_fk}}');
        $this->dropIndex('article', '{{%module_blog_cat_article_fk}}');
        $this->dropTable('{{%module_blog_cat_article_fk}}');
    }
}
