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

class m220103_043841_module_widget extends Migration
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
            '{{%module_widget}}',
            [
                'id'              => $this->primaryKey(11),
                'content'         => $this->text()->notNull(),
                'shortCode'       => $this->string(255)->notNull(),
                'language'        => $this->integer(11)->null()->defaultValue(null),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
                'title'           => $this->string(255)->notNull(),
            ], $tableOptions
        );
        $this->createIndex('language', '{{%module_widget}}', ['language'], false);
        $this->createIndex('language_parent', '{{%module_widget}}', ['language_parent'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('language', '{{%module_widget}}');
        $this->dropIndex('language_parent', '{{%module_widget}}');
        $this->dropTable('{{%module_widget}}');
    }
}
