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

class m220103_043250_module_slug extends Migration
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
            '{{%module_slug}}',
            [
                'id'         => $this->primaryKey(11),
                'table_name' => $this->string(255)->notNull(),
                'table_id'   => $this->integer(11)->notNull(),
                'slug'       => $this->string(255)->notNull(),
            ], $tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%module_slug}}');
    }
}
