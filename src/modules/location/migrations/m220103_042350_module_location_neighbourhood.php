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

class m220103_042350_module_location_neighbourhood extends Migration
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
            '{{%module_location_neighbourhood}}',
            [
                'id'              => $this->primaryKey(11),
                'name'            => $this->string(255)->notNull(),
                'city'            => $this->integer(11)->notNull(),
                'language'        => $this->integer(11)->null()->defaultValue(null),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('city', '{{%module_location_neighbourhood}}', ['city'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('city', '{{%module_location_neighbourhood}}');
        $this->dropTable('{{%module_location_neighbourhood}}');
    }
}
