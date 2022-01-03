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

class m220103_042318_module_language extends Migration
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
            '{{%module_language}}',
            [
                'id'              => $this->primaryKey(11),
                'title'           => $this->string(50)->notNull(),
                'image'           => $this->string(255)->null()->defaultValue(null),
                'code'            => $this->string(50)->null()->defaultValue(null),
                'status'          => $this->tinyInteger(1)->notNull(),
                'layout'          => $this->string(4)->notNull(),
                'default'         => $this->tinyInteger(1)->null()->defaultValue(null),
                'app'             => $this->string(10)->notNull(),
                'shortCode'       => $this->string(10)->notNull(),
                'dateMode'        => $this->string(11)->notNull(),
                'site'            => $this->integer(11)->notNull(),
                'language'        => $this->integer(11)->null()->defaultValue(null),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('default', '{{%module_language}}', ['default'], true);
        $this->createIndex('site', '{{%module_language}}', ['site'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('default', '{{%module_language}}');
        $this->dropIndex('site', '{{%module_language}}');
        $this->dropTable('{{%module_language}}');
    }
}
