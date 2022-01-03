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

class m220103_042603_module_notification_users_settings extends Migration
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
            '{{%module_notification_users_settings}}',
            [
                'id'              => $this->primaryKey(11),
                'uid'             => $this->integer(11)->notNull(),
                'options'         => $this->text()->notNull(),
                'language'        => $this->integer(11)->null()->defaultValue(null),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('uid', '{{%module_notification_users_settings}}', ['uid'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('uid', '{{%module_notification_users_settings}}');
        $this->dropTable('{{%module_notification_users_settings}}');
    }
}
