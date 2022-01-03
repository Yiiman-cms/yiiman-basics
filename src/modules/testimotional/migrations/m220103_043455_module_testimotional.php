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

class m220103_043455_module_testimotional extends Migration
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
            '{{%module_testimotional}}',
            [
                'id'              => $this->primaryKey(11),
                'content'         => $this->string(500)->notNull(),
                'author'          => $this->string(255)->notNull(),
                'job'             => $this->string(255)->null()->defaultValue(null),
                'index'           => $this->integer(11)->null()->defaultValue(null),
                'created_at'      => $this->datetime()->notNull(),
                'updated_at'      => $this->datetime()->null()->defaultValue(null),
                'status'          => $this->tinyInteger(1)->notNull(),
                'image'           => $this->string(400)->null()->defaultValue(null),
                'language'        => $this->integer(11)->notNull(),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('language_parent', '{{%module_testimotional}}', ['language_parent'], false);
        $this->createIndex('language', '{{%module_testimotional}}', ['language'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('language_parent', '{{%module_testimotional}}');
        $this->dropIndex('language', '{{%module_testimotional}}');
        $this->dropTable('{{%module_testimotional}}');
    }
}
