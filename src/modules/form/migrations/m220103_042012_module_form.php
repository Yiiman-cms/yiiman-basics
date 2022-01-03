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

class m220103_042012_module_form extends Migration
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
            '{{%module_form}}',
            [
                'id'      => $this->primaryKey(11),
                'title'   => $this->string(255)->notNull(),
                'details' => $this->text()->notNull(),
            ], $tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%module_form}}');
    }
}
