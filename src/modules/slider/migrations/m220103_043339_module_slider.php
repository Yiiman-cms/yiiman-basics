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

class m220103_043339_module_slider extends Migration
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
            '{{%module_slider}}',
            [
                'id'              => $this->primaryKey(11),
                'title'           => $this->string(255)->notNull(),
                'index'           => $this->tinyInteger(1)->null()->defaultValue(null),
                'status'          => $this->tinyInteger(1)->notNull(),
                'data'            => $this->text()->null()->defaultValue(null),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
                'language'        => $this->integer(11)->null()->defaultValue(null),
                'title2'          => $this->string(255)->null()->defaultValue(null),
                'link'            => $this->string(255)->null()->defaultValue(null),
                'linkDescription' => $this->string(255)->null()->defaultValue(null),
                'topMargin'       => $this->integer(10)->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('language_parent', '{{%module_slider}}', ['language_parent'], false);
        $this->createIndex('language', '{{%module_slider}}', ['language'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('language_parent', '{{%module_slider}}');
        $this->dropIndex('language', '{{%module_slider}}');
        $this->dropTable('{{%module_slider}}');
    }
}
