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

class m220103_042814_module_posttypes_multiples extends Migration
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
            '{{%module_posttypes_multiples}}',
            [
                'id'              => $this->primaryKey(11),
                'key'             => $this->string(255)->notNull(),
                'value'           => $this->string(255)->null()->defaultValue(null),
                'posttype_id'     => $this->integer(11)->notNull(),
                'posttype'        => $this->string(255)->notNull(),
                'fieldName'       => $this->string(255)->notNull(),
                'index'           => $this->integer(11)->notNull(),
                'type'            => $this->string(255)->notNull(),
                'language'        => $this->integer(11)->null()->defaultValue(null),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('posttype_id', '{{%module_posttypes_multiples}}', ['posttype_id'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('posttype_id', '{{%module_posttypes_multiples}}');
        $this->dropTable('{{%module_posttypes_multiples}}');
    }
}
