<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\db\Schema;
use yii\db\Migration;

class m220103_032516_Relations extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_module_blog_cat_article_fk_category',
            '{{%module_blog_cat_article_fk}}', 'category',
            '{{%module_blog_category}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_blog_cat_article_fk_article',
            '{{%module_blog_cat_article_fk}}', 'article',
            '{{%module_blog_articles}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_blog_category_parent',
            '{{%module_blog_category}}', 'parent',
            '{{%module_blog_category}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_blog_comment_parent',
            '{{%module_blog_comment}}', 'parent',
            '{{%module_blog_comment}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_module_blog_cat_article_fk_category', '{{%module_blog_cat_article_fk}}');
        $this->dropForeignKey('fk_module_blog_cat_article_fk_article', '{{%module_blog_cat_article_fk}}');
        $this->dropForeignKey('fk_module_blog_category_parent', '{{%module_blog_category}}');
        $this->dropForeignKey('fk_module_blog_comment_parent', '{{%module_blog_comment}}');
    }
}
