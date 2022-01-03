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

class m220103_042811_module_posttypes extends Migration
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
            '{{%module_posttypes}}',
            [
                'id'              => $this->primaryKey(11),
                'title'           => $this->string(255)->notNull(),
                'language'        => $this->integer(11)->null()->defaultValue(null),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
                'postType'        => $this->string(255)->notNull(),
                'status'          => $this->tinyInteger(1)->notNull(),
                'created_at'      => $this->datetime()->notNull(),
                'updated_at'      => $this->datetime()->null()->defaultValue(null),
                'created_by'      => $this->string(255)->notNull(),
                'content'         => $this->text()->null()->defaultValue(null),
                'hash'            => $this->string(255)->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('title', '{{%module_posttypes}}', ['title'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('title', '{{%module_posttypes}}');
        $this->dropTable('{{%module_posttypes}}');
    }
}
