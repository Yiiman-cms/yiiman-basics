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

class m220103_032515_module_blog_comment extends Migration
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
            '{{%module_blog_comment}}',
            [
                'id'         => $this->primaryKey(11),
                'message'    => $this->string(1000)->notNull(),
                'name'       => $this->string(50)->null()->defaultValue(null),
                'email'      => $this->string(100)->null()->defaultValue(null),
                'website'    => $this->string(100)->null()->defaultValue(null),
                'article'    => $this->integer(11)->notNull(),
                'created_at' => $this->datetime()->notNull(),
                'status'     => $this->tinyInteger(1)->notNull(),
                'parent'     => $this->integer(11)->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('parent', '{{%module_blog_comment}}', ['parent'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('parent', '{{%module_blog_comment}}');
        $this->dropTable('{{%module_blog_comment}}');
    }
}
